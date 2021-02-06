<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Comment;
use App\Models\Recipe;
use App\Policies\CommentPolicy;
use App\Policies\RecipePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

final class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Recipe::class => RecipePolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
