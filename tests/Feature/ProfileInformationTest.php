<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;
use Livewire\Livewire;

it('can view profile information', function (): void {
    $this->actingAs($user = User::factory()->create());

    $component = Livewire::test(UpdateProfileInformationForm::class);

    $this->assertEquals($user->name, $component->state['name']);
    $this->assertEquals($user->email, $component->state['email']);
});

it('can update the user profile information', function (): void {
    $this->actingAs(User::factory()->create());

    Livewire::test(UpdateProfileInformationForm::class)
        ->set('state', [
            'name' => 'Test Name',
            'email' => 'test@example.com',
        ])
        ->call('updateProfileInformation');

    $this->assertDatabaseHas('users', [
        'name' => 'Test Name',
        'email' => 'test@example.com',
    ]);
});

it('can update the user photo', function (): void {
    $this->actingAs($user = User::factory()->create());

    $file = UploadedFile::fake()->image('avatar.jpg');

    Livewire::test(UpdateProfileInformationForm::class)
        ->set('state.photo', $file)
        ->call('updateProfileInformation');

    $user->refresh();

    $this->assertNotNull($user->profile_photo_path);
});
