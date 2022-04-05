<?php

declare(strict_types=1);

use App\Filament\Resources\CommentResource;
use App\Models\Comment;
use App\Models\User;

beforeEach(function (): void {
    $this->actingAs(User::factory()->admin()->create());
});

it('can render index', function (): void {
    $this->get(CommentResource::getUrl('index'))->assertSuccessful();
});

it('can render create', function (): void {
    $this->get(CommentResource::getUrl('create'))->assertSuccessful();
});

it('can create', function (): void {
    $comment = Comment::factory()->make();

    Livewire::test(CommentResource\Pages\CreateComment::class)
        ->set('data.message', $comment->message)
        ->set('data.user_id', $comment->user_id)
        ->set('data.recipe_id', $comment->recipe_id)
        ->call('create')
        ->assertHasNoErrors();

    $this->assertDatabaseCount(Comment::class, 1);
    $this->assertDatabaseHas(Comment::class, [
        'message' => $comment->message,
        'user_id' => $comment->user_id,
        'recipe_id' => $comment->recipe_id,
    ]);
});

it('can validate create', function (): void {
    Livewire::test(CommentResource\Pages\CreateComment::class)
        ->set('data.message', null)
        ->call('create')
        ->assertHasErrors(['data.message' => 'required']);
});

it('can render edit', function (): void {
    $comment = Comment::factory()->create();

    $this->get(CommentResource::getUrl('edit', ['record' => $comment->id]))->assertSuccessful();
});

it('can update', function (): void {
    $comment = Comment::factory()->create();
    $new = Comment::factory()->make();

    Livewire::test(CommentResource\Pages\EditComment::class, ['record' => $comment->id])
        ->set('data.message', $new->message)
        ->set('data.user_id', $new->user_id)
        ->set('data.recipe_id', $new->recipe_id)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseCount(Comment::class, 1);
    $this->assertDatabaseHas(Comment::class, [
        'message' => $new->message,
        'user_id' => $new->user_id,
        'recipe_id' => $new->recipe_id,
    ]);
});
