<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Avoids session/cache/queue needing DB tables before migrations complete.
 */
final class ForceInstallerRuntimeConfig
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('install') || $request->is('install/*')) {
            config([
                'session.driver' => 'file',
                'cache.default' => 'file',
                'queue.default' => 'sync',
            ]);
        }

        return $next($request);
    }
}
