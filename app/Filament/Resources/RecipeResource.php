<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\RecipeResource\Pages;
use App\Filament\Resources\RecipeResource\RelationManagers\CommentsRelationManager;
use App\Filament\Resources\RecipeResource\RelationManagers\IngredientsRelationManager;
use App\Filament\Resources\RecipeResource\RelationManagers\InstructionsRelationManager;
use App\Models\Recipe;
use App\Models\Tag;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

final class RecipeResource extends Resource
{
    protected static ?string $model = Recipe::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationIcon = 'heroicon-o-database';

    protected static ?int $navigationSort = 0;

    public static function getLabel(): string
    {
        return __('Recipe');
    }

    public static function getPluralLabel(): string
    {
        return __('Recipes');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('Title'))
                    ->required(),
                Forms\Components\Textarea::make('description')->label(__('Description'))->required(),
                Forms\Components\TextInput::make('duration')->label(__('Duration'))->numeric()->required(),
                Forms\Components\TextInput::make('yield')->label(__('Yield'))->numeric()->required(),
                Forms\Components\BelongsToSelect::make('category_id')
                    ->label(__('Category'))
                    ->relationship('category', 'name')
                    ->saveRelationshipsUsing(null)
                    ->required(),
                Forms\Components\BelongsToSelect::make('user_id')
                    ->label(__('User'))
                    ->relationship('user', 'name')
                    ->saveRelationshipsUsing(null)
                    ->searchable()
                    ->required(),
                Forms\Components\BelongsToManyMultiSelect::make('tags')
                    ->label(__('Tags'))
                    ->relationship('tags', 'name'),
                Forms\Components\FileUpload::make('image')->label(__('Image'))->disk('recipes')->image()->nullable(),
                Forms\Components\DatePicker::make('created_at')
                    ->label(__('Created at'))
                    ->displayFormat('d-m-Y H:i')
                    ->when(fn ($state) => $state)
                    ->disabled(),
                Forms\Components\DatePicker::make('updated_at')
                    ->label(__('Updated at'))
                    ->displayFormat('d-m-Y H:i')
                    ->when(fn ($state) => $state)
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('Image'))
                    ->disk('recipes'),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('Title'))
                    ->limit(30),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('User'))
                    ->limit(30),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime('d-m-Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user')
                    ->label(__('User'))
                    ->relationship('user', 'name'),
                Tables\Filters\SelectFilter::make('category')
                    ->label(__('Category'))
                    ->relationship('category', 'name'),
                Tables\Filters\SelectFilter::make('tag')
                    ->label(__('Tag'))
                    ->options(fn () => Tag::pluck('name', 'id'))
                    ->query(function (Builder $query, $data) {
                        return $query->when($data['value'], function (Builder $query) use ($data) {
                            return $query->whereRelation('tags', 'id', '=', $data['value']);
                        });
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            IngredientsRelationManager::class,
            InstructionsRelationManager::class,
            CommentsRelationManager::class,
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
