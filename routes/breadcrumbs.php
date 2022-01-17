<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\Recipe;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for('dashboard', function ($trail): void {
    $trail->push(__('Home'), route('dashboard'));
});

Breadcrumbs::for('recipes.index', function ($trail): void {
    $trail->parent('dashboard');
    $trail->push(__('Recipes'), route('recipes.index'));
});

Breadcrumbs::for('recipes.create', function ($trail): void {
    $trail->parent('recipes.index');
    $trail->push(__('Create'), route('recipes.create'));
});

Breadcrumbs::for('recipes.show', function ($trail, Recipe $recipe): void {
    $trail->parent('recipes.index');
    $trail->push(Str::limit($recipe->title, 30), route('recipes.show', $recipe));
});

Breadcrumbs::for('recipes.edit', function ($trail, Recipe $recipe): void {
    $trail->parent('recipes.show', $recipe);
    $trail->push(__('Edit'), route('recipes.edit', $recipe));
});

Breadcrumbs::for('author.show', function ($trail, User $user): void {
    $trail->parent('dashboard');
    $title = Str::limit($user->name, 30);
    if ($user->is(Auth::user())) {
        $title = __('My recipes');
    }
    $trail->push($title, route('author.show', $user));
});

Breadcrumbs::for('admin', function ($trail): void {
    $trail->parent('dashboard');
    $trail->push(__('Admin'));
});

Breadcrumbs::for('users.index', function ($trail): void {
    $trail->parent('admin');
    $trail->push(__('Users'), route('users.index'));
});

Breadcrumbs::for('users.create', function ($trail): void {
    $trail->parent('users.index');
    $trail->push(__('Create'), route('users.create'));
});

Breadcrumbs::for('users.edit', function ($trail, User $user): void {
    $trail->parent('users.index');
    $trail->push(Str::limit($user->name, 30));
    $trail->push(__('Edit'), route('users.edit', $user));
});

Breadcrumbs::for('categories.index', function ($trail): void {
    $trail->parent('admin');
    $trail->push(__('Categories'), route('categories.index'));
});

Breadcrumbs::for('categories.create', function ($trail): void {
    $trail->parent('categories.index');
    $trail->push(__('Create'), route('categories.create'));
});

Breadcrumbs::for('categories.edit', function ($trail, Category $category): void {
    $trail->parent('categories.index');
    $trail->push(Str::limit($category->name, 30));
    $trail->push(__('Edit'), route('categories.edit', $category));
});

Breadcrumbs::for('profile.show', function ($trail): void {
    $trail->parent('dashboard');
    $trail->push(__('Profile'), route('profile.show'));
});

Breadcrumbs::for('api-tokens.index', function ($trail): void {
    $trail->parent('dashboard');
    $trail->push(__('API Tokens'), route('api-tokens.index'));
});
