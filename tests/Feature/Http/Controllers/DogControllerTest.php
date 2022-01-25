<?php

declare(strict_types=1);

it('can see dog', function (): void {
    $response = $this->get(route('hondje'));

    $response->assertOk();
    $response->assertSee('Hondje');
});
