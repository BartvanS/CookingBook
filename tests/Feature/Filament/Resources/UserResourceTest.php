<?php

declare(strict_types=1);

use App\Filament\Resources\UserResource;
use App\Models\User;

beforeEach(function (): void {
    $this->actingAs(User::factory()->admin()->create());
});

it('can render index', function (): void {
    $this->get(UserResource::getUrl('index'))->assertSuccessful();
});

it('can render create', function (): void {
    $this->get(UserResource::getUrl('create'))->assertSuccessful();
});

it('can create', function (): void {
    $user = User::factory()->make();

    Livewire::test(UserResource\Pages\CreateUser::class)
        ->set('data.name', $user->name)
        ->set('data.email', $user->email)
        ->set('data.password', 'password')
        ->call('create');

    $this->assertDatabaseHas(User::class, [
        'name' => $user->name,
        'email' => $user->email,
    ]);
});

it('can validate create', function (): void {
    Livewire::test(UserResource\Pages\CreateUser::class)
        ->set('data.name', null)
        ->call('create')
        ->assertHasErrors(['data.name' => 'required']);
});

it('can render edit', function (): void {
    $user = User::factory()->create();

    $this->get(UserResource::getUrl('edit', ['record' => $user->id]))->assertSuccessful();
});

it('can update', function (): void {
    $new = User::factory()->create();

    Livewire::test(UserResource\Pages\EditUser::class, ['record' => $new->id])
        ->set('data.name', $new->name)
        ->set('data.email', $new->email)
        ->set('data.password', 'password')
        ->call('save');

    $this->assertDatabaseHas(User::class, [
        'name' => $new->name,
        'email' => $new->email,
    ]);
});
