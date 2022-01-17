<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

final class DogControllerTest extends TestCase
{
    public function testCanViewRandomHondje(): void
    {
        $response = $this->get(route('hondje'));

        $response->assertOk();

        $response->assertSee('Hondje');
    }
}
