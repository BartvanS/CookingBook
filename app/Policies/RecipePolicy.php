<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class RecipePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Recipe $recipe): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Recipe $recipe): bool
    {
        return $recipe->user->is($user) || $user->is_admin;
    }

    public function delete(User $user, Recipe $recipe): bool
    {
        return $recipe->user->is($user) || $user->is_admin;
    }

    public function restore(User $user, Recipe $recipe): bool
    {
        return $user->is_admin;
    }

    public function forceDelete(User $user, Recipe $recipe): bool
    {
        return false;
    }
}
