<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

final class MakeServiceCommand extends GeneratorCommand
{
    protected $name = 'make:service';

    protected $description = 'Create a new service class';

    protected $type = 'class';

    protected function getStub(): string
    {
        return base_path('stubs/service.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Services';
    }
}
