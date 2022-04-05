<?php

declare(strict_types=1);

namespace App\Filament\Resources\RecipeResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

final class InstructionsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'instructions';

    protected static ?string $recordTitleAttribute = 'instruction';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('instruction')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('instruction'),
            ]);
    }
}
