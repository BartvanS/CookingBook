<?php

namespace Tests\Feature\Http\Livewire;

use App\Http\Livewire\Recipes;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RecipesTest extends TestCase
{
    use RefreshDatabase;

    public function test_example()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(Recipes::class)
            ->set('search', 'test');
    }
}
