<?php

declare(strict_types=1);

namespace App\Filament\Resources\RecipeResource\Pages;

use App\Filament\Resources\RecipeResource;
use Filament\Resources\Pages\EditRecord;

final class EditRecipe extends EditRecord
{
    protected static string $resource = RecipeResource::class;
}
