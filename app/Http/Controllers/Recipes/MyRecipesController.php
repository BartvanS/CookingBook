<?php

declare(strict_types=1);

namespace App\Http\Controllers\Recipes;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class MyRecipesController
{
    public function __invoke(Request $request): View
    {
        return view('author.show')->with('user', $request->user());
    }
}
