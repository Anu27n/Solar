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
            return redirect()->to('/');
        }

        return $next($request);
    }
}
