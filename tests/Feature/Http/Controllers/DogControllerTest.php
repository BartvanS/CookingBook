<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class DogControllerTest extends TestCase
{
    public function testCanViewRandomHondje()
    {
        $response = $this->get(route('hondje'));

        $response->assertOk();

        $response->assertSee('Hondje');
    }
}
