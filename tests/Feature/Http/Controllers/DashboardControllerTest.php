<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\Comment;
use App\Models\Recipe;
use App\Models\User;
use Tests\TestCase;

final class DashboardControllerTest extends TestCase
{
    public function testCanViewDashboard(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('dashboard'));

        $response->assertOk();
    }

    public function testCanViewLatestComments(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $recipe = Recipe::factory()->create(['user_id' => $user]);
        $comment = Comment::factory()->create(['recipe_id' => $recipe]);

        $response = $this->get(route('dashboard'));

        $response->assertOk();
        $response->assertSeeText($comment->message);
    }
}
