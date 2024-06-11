<?php


use App\Http\Middleware\CheckAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'checkAdmin' => CheckAdmin::class
        ]);
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('app:process-parent-view-data')->everyFiveMinutes();
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('app:process-child-view-data')->everyMinute();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
