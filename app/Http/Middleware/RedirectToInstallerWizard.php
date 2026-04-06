<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Support\Installer;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class RedirectToInstallerWizard
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Installer::isLocked()) {
            return $next($request);
        }

        if ($request->is('install') || $request->is('install/*')) {
            return $next($request);
        }

        if ($request->is('up')) {
            return $next($request);
        }

        return redirect('/install');
    }
}
