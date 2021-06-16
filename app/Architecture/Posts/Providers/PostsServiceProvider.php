<?php

namespace App\Architecture\Posts\Providers;

use App\Architecture\Posts\Interfaces\IPostRepository;
use App\Architecture\Posts\Interfaces\IPostService;
use App\Architecture\Posts\Repositories\PostRepository;
use App\Architecture\Posts\Services\PostService;
use Illuminate\Support\ServiceProvider;

class PostsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            IPostRepository::class,
            PostRepository::class
        );

        $this->app->singleton(
            IPostService::class,
            PostService::class
        );
    }
}
