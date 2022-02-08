<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Recipes;

use App\Models\User;
use Tests\TestCase;

final class MyRecipesControllerTest extends TestCase
{
    public function test_can_view_my_recipes(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('my-recipes'));
        $response->assertOk();
    }
}
