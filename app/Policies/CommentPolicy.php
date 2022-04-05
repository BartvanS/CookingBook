<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class CommentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Comment $comment): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Comment $comment): bool
    {
        return $comment->user->is($user) || $user->is_admin;
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $comment->user->is($user) || $user->is_admin;
    }

    public function restore(User $user, Comment $comment): bool
    {
        return $user->is_admin;
    }

    public function forceDelete(User $user, Comment $comment): bool
    {
        return false;
    }
}
