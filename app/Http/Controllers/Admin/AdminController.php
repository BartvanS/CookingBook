<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Contracts\View\View;

final class AdminController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.index', [
            'recipes' => Recipe::count(),
            'users' => User::count(),
            'categories' => Category::count(),
            'tags' => Tag::count(),
        ]);
    }
}
