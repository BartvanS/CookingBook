<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertRedirect('/recipes');
    }
}
