<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class MyRecipesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCanViewMyRecipes()
    {
        $user = User::factory()->create();

        Recipe::factory()->count(5)->create([
            'user_id' => $user,
        ]);

        $this->actingAs($user);

        $response = $this->get(route('my-recipes'));

        $response->assertStatus(200);
    }
}
