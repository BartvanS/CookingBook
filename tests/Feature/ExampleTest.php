<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get('/');

        $response->assertRedirect('/recipes');
    }
}
