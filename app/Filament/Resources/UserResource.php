<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

final class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 3;

    public static function getLabel(): string
    {
        return __('User');
    }

    public static function getPluralLabel(): string
    {
        return __('Users');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('password')->password()->required(),
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
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name')),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('Email')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime('d-m-Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('is_admin')
                    ->label(__('Admin'))
                    ->query(fn (Builder $query) => $query->where('is_admin', true)),
                Filter::make('verified')
                    ->label(__('Email verified'))
                    ->query(fn (Builder $query) => $query->whereNotNull('email_verified_at')),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
