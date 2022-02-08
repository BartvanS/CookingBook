<?php

declare(strict_types=1);

namespace App\Console;

use App\Console\Commands\CopyImages;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

final class Kernel extends ConsoleKernel
{
    protected $commands = [
        CopyImages::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->call('health:check')->everyFiveMinutes();
    }
}
