<?php

declare(strict_types=1);

use App\Filament\Widgets\StatsOverviewWidget;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\User;

beforeEach(function (): void {
    $this->actingAs(User::factory()->admin()->create());
});

it('can view overview widget', function (): void {
    Recipe::factory()->count(5)->create();
    Category::factory()->count(2)->create();

    Livewire::test(StatsOverviewWidget::class)
        ->assertSeeText([
            'Recepten',
            'Gebruikers',
            'Categorieën',
        ]);
});
