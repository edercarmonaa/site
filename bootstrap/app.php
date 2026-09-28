<?php

use App\Http\Middleware\SecurityHeaders;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Throwable;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withCommands([
        App\Console\Commands\ClearContentCacheCommand::class,
        App\Console\Commands\VersionCommand::class,
    ])
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(SecurityHeaders::class);
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, Request $request) {
            $status = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            if ($request->expectsJson()) {
                return null;
            }

            if (array_key_exists($status, config('errors.pages', []))) {
                return response()->view('errors.show', ['status' => $status], $status);
            }

            return null;
        });
    })->create();
