<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\DeleteUserForm;
use Livewire\Livewire;
use Tests\TestCase;

final class DeleteAccountTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_accounts_can_be_deleted(): void
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(DeleteUserForm::class)
            ->set('password', 'password')
            ->call('deleteUser');

        $this->assertSoftDeleted($user);
    }

    public function test_correct_password_must_be_provided_before_account_can_be_deleted(): void
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(DeleteUserForm::class)
            ->set('password', 'wrong-password')
            ->call('deleteUser')
            ->assertHasErrors(['password']);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'deleted_at' => null,
        ]);
    }

    public function test_related_models_are_deleted(): void
    {
        $this->actingAs($user = User::factory()->create());

        $recipe = Recipe::factory()->create([
            'user_id' => $user,
        ]);

        $comment = Comment::factory()->create([
            'user_id' => $user,
        ]);

        Livewire::test(DeleteUserForm::class)
            ->set('password', 'password')
            ->call('deleteUser');

        $this->assertSoftDeleted($user);
        $this->assertSoftDeleted($recipe);
        $this->assertSoftDeleted($comment);
    }
}
