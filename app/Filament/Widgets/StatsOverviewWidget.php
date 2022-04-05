<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Recipe;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

final class StatsOverviewWidget extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make(__('Recipes'), Recipe::count()),
            Card::make(__('Users'), User::count()),
            Card::make(__('Categories'), Category::count()),
        ];
    }
}
