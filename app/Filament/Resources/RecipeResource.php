<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\RecipeResource\Pages;
use App\Models\Category;
use App\Models\Recipe;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;

final class RecipeResource extends Resource
{
    protected static ?string $model = Recipe::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationIcon = 'heroicon-o-database';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('title')->label(__('Title'))->required(),
                Forms\Components\Textarea::make('description')->label(__('Description'))->required(),
                Forms\Components\TextInput::make('duration')->label(__('Duration'))->numeric()->required(),
                Forms\Components\TextInput::make('yield')->label(__('Yield'))->numeric()->required(),
                Forms\Components\Select::make('category_id')
                    ->label(__('Category'))
                    ->options(Category::all()->pluck('name', 'id'))
                    ->exists('categories')
                    ->searchable()
                    ->required(),
                Forms\Components\FileUpload::make('image')->label(__('Image'))->disk('recipes')->image()->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->disk('recipes'),
                Tables\Columns\TextColumn::make('title')->limit(30),
                Tables\Columns\TextColumn::make('description')->limit(30),
                Tables\Columns\TextColumn::make('duration'),
                Tables\Columns\TextColumn::make('yield'),
            ])
            ->filters([
                SelectFilter::make('category')->relationship('category', 'name'),
//                SelectFilter::make('category')->relationship('tags', 'name'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecipes::route('/'),
            'create' => Pages\CreateRecipe::route('/create'),
            'edit' => Pages\EditRecipe::route('/{record}/edit'),
        ];
    }
}
