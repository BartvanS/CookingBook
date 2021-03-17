<?php

declare(strict_types=1);

namespace App\Actions\Jetstream;

use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesUsers;

final class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user and all associated models.
     *
     * @param User $user
     */
    public function delete($user)
    {
        $user->comments()->delete();

        $user->recipes()->delete();

        $user->delete();
    }
}
