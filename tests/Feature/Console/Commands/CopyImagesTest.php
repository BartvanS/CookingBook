<?php

declare(strict_types=1);

namespace Tests\Feature\Console\Commands;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

final class CopyImagesTest extends TestCase
{
    public function test_copy_images(): void
    {
        App::shouldReceive('isLocal')
            ->times(1)
            ->andReturn(true);
        $storage = Storage::fake('recipes');

        $this->artisan('image:copy')->assertSuccessful();

        $this->assertTrue($storage->exists('1.jpeg'));
        $this->assertCount(9, $storage->allFiles());
    }

    public function test_cannot_run_on_production(): void
    {
        App::shouldReceive('isLocal')
            ->times(1)
            ->andReturn(false);
        $storage = Storage::fake('recipes');

        $this->artisan('image:copy')->assertFailed();

        $this->assertFalse($storage->exists('1.jpeg'));
        $this->assertCount(0, $storage->allFiles());
    }
}
