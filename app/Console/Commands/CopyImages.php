<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

final class CopyImages extends Command
{
    protected $signature = 'image:copy';

    public function handle(): int
    {
        if (! App::isLocal()) {
            $this->error('Environment is not local.');

            return 1;
        }

        $files = File::files(base_path('dev/images'));
        $photos = Storage::disk('recipes');

        foreach ($files as $file) {
            $photos->put($file->getFilename(), $file->getContents());
        }

        $this->info(sprintf('%s files copied', count($files)));

        return 0;
    }
}
