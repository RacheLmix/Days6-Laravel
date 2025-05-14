<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    public function boot(): void
    {
        Gate::define('edit-post', function (User $user, Post $post) {
            return $user->id === $post->user_id || $user->is_admin;
        });

        // Define admin-access gate
        Gate::define('admin-access', function (User $user) {
            return $user->is_admin || $user->admin === 'admin';
        });
    }
}