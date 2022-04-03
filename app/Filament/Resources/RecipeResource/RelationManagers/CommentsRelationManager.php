<?php

declare(strict_types=1);

namespace App\Filament\Resources\RecipeResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

final class CommentsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'comments';

    protected static ?string $recordTitleAttribute = 'message';

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
                Tables\Columns\TextColumn::make('message')->label(__('Message'))->limit(50),
                Tables\Columns\TextColumn::make('user.name')->label(__('User')),
                Tables\Columns\TextColumn::make('created_at')->label(__('Created at'))->dateTime('d-m-Y H:i')->sortable(),
            ]);
    }
}
