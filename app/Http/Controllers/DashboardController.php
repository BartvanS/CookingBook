<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;

final class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        $categories = Category::query()
            ->with('latestRecipe', fn (HasOne $query) => $query->whereNotNull('thumbnail'))
            ->withCount('recipes')
            ->orderByDesc('recipes_count')
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
