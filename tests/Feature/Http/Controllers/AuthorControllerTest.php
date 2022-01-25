<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Tests\TestCase;

final class AuthorControllerTest extends TestCase
{
    public function test_example(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('author.show', User::factory()->create()));

        $response->assertOk();
    }
}
