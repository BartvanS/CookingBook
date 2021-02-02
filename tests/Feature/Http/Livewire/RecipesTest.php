<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Livewire;

use App\Http\Livewire\RecipesTable;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

final class RecipesTest extends TestCase
{
    use RefreshDatabase;

    public function test_example()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(RecipesTable::class)
            ->set('search', 'test');
    }
}
