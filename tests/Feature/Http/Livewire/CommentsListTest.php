<?php

namespace Tests\Feature\Http\Livewire;

use App\Http\Livewire\CommentsList;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CommentsListTest extends TestCase
{
    use RefreshDatabase;

    public function testCanSubmitComment()
    {
        $this->actingAs(User::factory()->create());

        $recipe = Recipe::factory()->create();

        Livewire::test(CommentsList::class, [$recipe])
            ->set('message', 'hello')
            ->call('submit');

        $this->assertDatabaseHas('comments', [
            'message' => 'hello',
        ]);
    }
}
