<?php

declare(strict_types=1);

namespace App\Console;

use App\Console\Commands\CopyImages;
use App\Console\Commands\UpdateImages;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

final class Kernel extends ConsoleKernel
{
    protected $commands = [
        CopyImages::class,
        UpdateImages::class,
    ];
}
