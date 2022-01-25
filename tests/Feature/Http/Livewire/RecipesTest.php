<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Livewire;

use App\Http\Livewire\Tables\RecipesTable;
use App\Models\Category;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

final class RecipesTest extends TestCase
{
    public function test_example(): void
    {
        $this->actingAs(User::factory()->create());

        $category = Category::factory()->create();

        Livewire::test(RecipesTable::class)
            ->set('search', 'test')
            ->set('category', $category->id);
    }
}
