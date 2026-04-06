<?php

declare(strict_types=1);

namespace App\Http\Controllers\Install;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Install\EnvironmentWriter;
use App\Support\Installer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use PDO;
use PDOException;
use Throwable;

final class InstallerController extends Controller
{
    public function welcome()
    {
        return view('install.welcome', ['step' => 1]);
    }

    public function requirements()
    {
        return view('install.requirements', [
            'step' => 2,
            'checks' => $this->requirementChecks(),
        ]);
    }

    public function requirementsContinue(Request $request): RedirectResponse
    {
        $failed = collect($this->requirementChecks())->contains(fn (array $c) => ! $c['pass']);
        if ($failed) {
            return redirect()
                ->route('install.requirements')
                ->withErrors(['requirements' => 'Fix the failed checks before continuing.']);
        }

        $request->session()->put('installer.requirements_ok', true);

        return redirect()->route('install.database');
    }

    public function databaseForm(Request $request): RedirectResponse|\Illuminate\View\View
    {
        if ($response = $this->guardPreviousStep($request, 'installer.requirements_ok', 'install.requirements')) {
            return $response;
        }

        return view('install.database', ['step' => 3]);
    }

    public function databaseSave(Request $request): RedirectResponse
    {
        if ($response = $this->guardPreviousStep($request, 'installer.requirements_ok', 'install.requirements')) {
            return $response;
        }

        $validated = $request->validate([
            'db_host' => ['required', 'string', 'max:255'],
            'db_port' => ['required', 'integer', 'min:1', 'max:65535'],
            'db_database' => ['required', 'string', 'max:128'],
            'db_username' => ['required', 'string', 'max:128'],
            'db_password' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            $this->testMysqlConnection(
                $validated['db_host'],
                (int) $validated['db_port'],
                $validated['db_database'],
                $validated['db_username'],
                $validated['db_password'] ?? '',
            );
        } catch (PDOException $e) {
            return back()->withInput()->withErrors(['db' => 'Could not connect to MySQL: '.$e->getMessage()]);
        }

        $request->session()->put('installer.db', $validated);

        return redirect()->route('install.configuration');
    }

    public function configurationForm(Request $request): RedirectResponse|\Illuminate\View\View
    {
        if ($response = $this->guardPreviousStep($request, 'installer.db', 'install.database')) {
            return $response;
        }

        return view('install.configuration', ['step' => 4]);
    }

    public function configurationSave(Request $request): RedirectResponse
    {
        if ($response = $this->guardPreviousStep($request, 'installer.db', 'install.database')) {
            return $response;
        }

        $validated = $request->validate([
            'app_name' => ['required', 'string', 'max:128'],
            'app_url' => ['required', 'url', 'max:255'],
            'app_debug' => ['nullable', 'boolean'],
            'mail_mailer' => ['nullable', 'string', 'max:32'],
            'mail_host' => ['nullable', 'string', 'max:255'],
            'mail_port' => ['nullable', 'string', 'max:10'],
            'mail_username' => ['nullable', 'string', 'max:255'],
            'mail_password' => ['nullable', 'string', 'max:255'],
            'mail_from_address' => ['nullable', 'email', 'max:255'],
            'mail_from_name' => ['nullable', 'string', 'max:128'],
        ]);

        $request->session()->put('installer.app', $validated);

        $examplePath = base_path('.env.example');
        if (! is_readable($examplePath)) {
            return back()->withErrors(['env' => '.env.example is missing from the project root.']);
        }

        $example = (string) file_get_contents($examplePath);
        $example = EnvironmentWriter::stripDatabaseLines($example);

        $db = $request->session()->get('installer.db');
        if (! is_array($db)) {
            return redirect()->route('install.database');
        }

        $appUrl = rtrim((string) $validated['app_url'], '/');
        $appKey = $this->readAppKeyFromEnv();
        if ($appKey === '') {
            $appKey = 'base64:'.base64_encode(random_bytes(32));
        }

        $overrides = [
            'APP_NAME' => (string) $validated['app_name'],
            'APP_ENV' => 'production',
            'APP_KEY' => $appKey,
            'APP_DEBUG' => ($request->boolean('app_debug')) ? 'true' : 'false',
            'APP_URL' => $appUrl,
            'DB_CONNECTION' => 'mysql',
            'DB_HOST' => (string) $db['db_host'],
            'DB_PORT' => (string) $db['db_port'],
            'DB_DATABASE' => (string) $db['db_database'],
            'DB_USERNAME' => (string) $db['db_username'],
            'DB_PASSWORD' => (string) ($db['db_password'] ?? ''),
            'SESSION_DRIVER' => 'database',
            'CACHE_STORE' => 'database',
            'QUEUE_CONNECTION' => 'database',
        ];

        if (filled($validated['mail_mailer'] ?? null)) {
            $overrides['MAIL_MAILER'] = (string) $validated['mail_mailer'];
        }
        if (filled($validated['mail_host'] ?? null)) {
            $overrides['MAIL_HOST'] = (string) $validated['mail_host'];
        }
        if (filled($validated['mail_port'] ?? null)) {
            $overrides['MAIL_PORT'] = (string) $validated['mail_port'];
        }
        if (array_key_exists('mail_username', $validated) && $validated['mail_username'] !== null) {
            $overrides['MAIL_USERNAME'] = (string) $validated['mail_username'];
        }
        if (array_key_exists('mail_password', $validated) && $validated['mail_password'] !== null) {
            $overrides['MAIL_PASSWORD'] = (string) $validated['mail_password'];
        }
        if (filled($validated['mail_from_address'] ?? null)) {
            $overrides['MAIL_FROM_ADDRESS'] = (string) $validated['mail_from_address'];
        }
        if (filled($validated['mail_from_name'] ?? null)) {
            $overrides['MAIL_FROM_NAME'] = (string) $validated['mail_from_name'];
        }

        $envContent = EnvironmentWriter::mergeIntoExample($example, $overrides);

        if (File::put(base_path('.env'), $envContent) === false) {
            return back()->withErrors(['env' => 'Could not write the .env file. Check permissions on the project root.']);
        }

        $request->session()->put('installer.env_written', true);

        return redirect()->route('install.migrate');
    }

    public function migrateForm(Request $request): RedirectResponse|\Illuminate\View\View
    {
        if ($response = $this->guardPreviousStep($request, 'installer.env_written', 'install.configuration')) {
            return $response;
        }

        return view('install.migrate', [
            'step' => 5,
            'lastLog' => $request->session()->get('installer.migrate_log'),
        ]);
    }

    public function migrateRun(Request $request): RedirectResponse
    {
        if ($response = $this->guardPreviousStep($request, 'installer.env_written', 'install.configuration')) {
            return $response;
        }

        $request->validate([
            'seed_packages' => ['nullable', 'boolean'],
        ]);

        try {
            Artisan::call('migrate', ['--force' => true]);
            $migrateOutput = Artisan::output();
        } catch (Throwable $e) {
            return back()->withErrors(['migrate' => 'Migration failed: '.$e->getMessage()]);
        }

        $seedLog = '';
        if ($request->boolean('seed_packages')) {
            try {
                Artisan::call('db:seed', [
                    '--class' => 'Database\\Seeders\\PackageSeeder',
                    '--force' => true,
                ]);
                $seedLog = Artisan::output();
            } catch (Throwable $e) {
                return back()->withErrors([
                    'migrate' => 'Migrations completed, but seeding failed: '.$e->getMessage(),
                ]);
            }
        }

        $request->session()->put('installer.migrated', true);
        $request->session()->put('installer.migrate_log', trim($migrateOutput."\n".$seedLog));

        return redirect()->route('install.admin');
    }

    public function adminForm(Request $request): RedirectResponse|\Illuminate\View\View
    {
        if ($response = $this->guardPreviousStep($request, 'installer.migrated', 'install.migrate')) {
            return $response;
        }

        return view('install.admin', ['step' => 6]);
    }

    public function adminSave(Request $request): RedirectResponse
    {
        if ($response = $this->guardPreviousStep($request, 'installer.migrated', 'install.migrate')) {
            return $response;
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'admin',
            'is_active' => true,
        ]);

        $request->session()->put('installer.admin_created', true);

        return redirect()->route('install.finish');
    }

    public function finish(Request $request): RedirectResponse|\Illuminate\View\View
    {
        if ($response = $this->guardPreviousStep($request, 'installer.admin_created', 'install.admin')) {
            return $response;
        }

        return view('install.finish', ['step' => 7]);
    }

    public function lock(Request $request): RedirectResponse
    {
        if ($response = $this->guardPreviousStep($request, 'installer.admin_created', 'install.admin')) {
            return $response;
        }

        $payload = json_encode([
            'locked_at' => now()->toIso8601String(),
            'app' => config('app.name'),
        ], JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);

        File::put(Installer::lockPath(), $payload);

        $request->session()->forget([
            'installer.requirements_ok',
            'installer.db',
            'installer.app',
            'installer.env_written',
            'installer.migrated',
            'installer.migrate_log',
            'installer.admin_created',
        ]);

        return redirect()->to('/')->with('installed', true);
    }

    /**
     * @return array<int, array{label: string, pass: bool, detail: string}>
     */
    private function requirementChecks(): array
    {
        $phpOk = version_compare(PHP_VERSION, '8.3.0', '>=');
        $exts = ['pdo', 'pdo_mysql', 'openssl', 'mbstring', 'tokenizer', 'xml', 'ctype', 'json', 'fileinfo', 'bcmath'];
        $extResults = [];
        foreach ($exts as $ext) {
            $extResults[] = [
                'label' => 'PHP extension: '.$ext,
                'pass' => extension_loaded($ext),
                'detail' => extension_loaded($ext) ? 'Loaded' : 'Missing',
            ];
        }

        $base = base_path();
        $writable = [
            ['label' => 'storage/ is writable', 'path' => $base.'/storage'],
            ['label' => 'bootstrap/cache/ is writable', 'path' => $base.'/bootstrap/cache'],
        ];
        $writeResults = [];
        foreach ($writable as $w) {
            $ok = is_dir($w['path']) && is_writable($w['path']);
            $writeResults[] = [
                'label' => $w['label'],
                'pass' => $ok,
                'detail' => $ok ? 'OK' : 'Not writable: '.$w['path'],
            ];
        }

        $example = base_path('.env.example');
        $exampleOk = is_readable($example);

        return array_merge(
            [[
                'label' => 'PHP 8.3+',
                'pass' => $phpOk,
                'detail' => 'Current: '.PHP_VERSION,
            ]],
            $extResults,
            $writeResults,
            [[
                'label' => '.env.example readable',
                'pass' => $exampleOk,
                'detail' => $exampleOk ? 'OK' : 'Missing .env.example',
            ]],
        );
    }

    private function guardPreviousStep(Request $request, string $sessionKey, ?string $route): ?RedirectResponse
    {
        if ($request->session()->has($sessionKey)) {
            return null;
        }

        return $route ? redirect()->route($route) : redirect()->route('install.welcome');
    }

    private function testMysqlConnection(
        string $host,
        int $port,
        string $database,
        string $username,
        string $password,
    ): void {
        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
            $host,
            $port,
            $database,
        );

        new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }

    private function readAppKeyFromEnv(): string
    {
        $path = base_path('.env');
        if (! is_readable($path)) {
            return '';
        }
        $raw = (string) file_get_contents($path);
        if (preg_match('/^APP_KEY=(.+)$/m', $raw, $m)) {
            $v = trim($m[1]);
            $v = trim($v, "'\"");

            return ($v === '' || strtolower($v) === 'null') ? '' : $v;
        }

        return '';
    }
}
