<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Posts;
use App\Policies\PostPolicy;

class AppServiceProvider extends ServiceProvider{     
    public function boot(): void
    {
        Paginator::useBootstrap();

        // Gate::define('post_update_delete', function (User $user, Posts $post) {
        //     return $user->id === $post->user_id;
        // });

        Gate::policy(Posts::class, PostPolicy::class);

    }
}

