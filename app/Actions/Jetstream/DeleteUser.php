<?php

declare(strict_types=1);

namespace App\Actions\Jetstream;

use Laravel\Jetstream\Contracts\DeletesUsers;

final class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     */
    public function delete($user)
    {
        $user->delete();
    }
}
