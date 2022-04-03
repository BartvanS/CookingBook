<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

final class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-annotation';

    protected static ?int $navigationSort = 4;

    public static function getLabel(): string
    {
        return __('Comment');
    }

    public static function getPluralLabel(): string
    {
        return __('Comments');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('message')
                    ->label(__('Message'))
                    ->required(),
                Forms\Components\BelongsToSelect::make('user_id')
                    ->label(__('User'))
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\BelongsToSelect::make('recipe_id')
                    ->label(__('Recipe'))
                    ->relationship('recipe', 'title')
                    ->searchable()
                    ->required(),
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
                Tables\Columns\TextColumn::make('message')
                    ->label(__('Message'))
                    ->limit(50),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('User')),
                Tables\Columns\TextColumn::make('recipe.title')
                    ->label(__('Recipe'))->limit(20),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime('d-m-Y H:i')
                    ->sortable(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
