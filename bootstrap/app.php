<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            // Route middleware aliases
            'role' => RoleMiddleware::class,
        ]);
    })->withSchedule(function (Schedule $schedule) {
        $schedule->command('salary:check')->monthlyOn(1, '00:00');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Symfony\Component\HttpKernel\Exception\HttpExceptionInterface $e, Illuminate\Http\Request $request) {
            if ($e->getStatusCode() === 403) {
                return redirect()->back()->with('error', 'Access Denied: You are not authorized to view this page.');
            }

            return null; // Let Laravel handle other exceptions
        });
    })->create();
