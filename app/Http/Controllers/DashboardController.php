<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

final class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        $categories = Category::withCount('recipes')
            ->selectSub(
                Recipe::select('thumbnail')
                    ->whereColumn('category_id', 'categories.id')
                    ->whereNotNull('thumbnail')
                    ->latest()
                    ->limit(1),
                'recipe_image'
            )
            ->orderByDesc('recipes_count')
            ->limit(3)
            ->get();

        $comments = Comment::with('recipe', 'user')
            ->where('user_id', '!=', $user->id)
            ->whereHas('recipe', fn (Builder $query) => $query->where('user_id', '=', $user->id))
            ->latest()
            ->limit(3)
            ->get();

        return view('dashboard', compact('categories', 'comments'));
    }
}
