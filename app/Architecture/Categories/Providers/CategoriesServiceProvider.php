<?php

namespace App\Architecture\Categories\Providers;

use Illuminate\Support\ServiceProvider;
use App\Architecture\Categories\Interfaces\ICategoryRepository;
use App\Architecture\Categories\Interfaces\ICategoryService;
use App\Architecture\Categories\Repositories\CategoryRepository;
use App\Architecture\Categories\Services\CategoryService;

class CategoriesServiceProvider extends ServiceProvider
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
          ICategoryRepository::class,
          CategoryRepository::class
        );

        $this->app->singleton(
          ICategoryService::class,
          CategoryService::class
        );
    }
}
