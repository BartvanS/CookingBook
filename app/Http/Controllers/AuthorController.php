<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;

final class AuthorController extends Controller
{
    public function show(User $user)
    {
        return view('author.show')->with('user', $user);
    }
}
