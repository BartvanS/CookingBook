<?php

declare(strict_types=1);

use function Pest\Laravel\artisan;

it('can run schedule', function (): void {
    artisan('schedule:run')
        ->assertSuccessful();
});
