<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

final class MakeActionCommand extends GeneratorCommand
{
    protected $name = 'make:action';

    protected $description = 'Create a new action class';

    protected $type = 'class';

    protected function getStub(): string
    {
        return base_path('stubs/action.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Actions';
    }
}
