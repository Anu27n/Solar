<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Support\Installer;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class RedirectIfInstallerLocked
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Installer::isLocked()) {
            return redirect()->route('login')
                ->with('info', 'Web installation is already complete. Log in here. (To re-run the wizard, delete storage/app/installer.lock on the server — not recommended on production.)');
        }

        return $next($request);
    }
}
