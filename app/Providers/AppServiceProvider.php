<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Idea;
use App\Models\Comment;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Pluralizer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootStrapFive();

        Gate::define('admin', function (User $user): bool {
            return $user->is_admin;
        });

        Gate::define('comment.owner', function (User $user, Comment $comment): bool {
            return $user->id === $comment->user_id;
        });

        Gate::define('comment.edit', function (User $user, Comment $comment): bool {
            return Gate::allows('admin') || Gate::allows('comment.owner', $comment);
        });

        Gate::define('comment.delete', function (User $user, Comment $comment): bool {
            return Gate::allows('admin') || Gate::allows('comment.owner', $comment);
        });

       $topUsers = User::withCount('ideas')->orderBy('ideas_count', 'DESC')->limit(5)->get();

        View::share(
            'topUsers',
            $topUsers
        );

    }
}
