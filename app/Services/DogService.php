<?php

declare(strict_types=1);

namespace App\Services;

final class DogService
{
    public function randomImage(): string
    {
        $dogs = collect([
            'pug.gif',
            'bruin.gif',
            'wit.gif',
            'witsmol.gif',
            'witzwart.gif',
            'zwart.gif',
        ]);

        return asset('img/' . $dogs->random());
    }
}
