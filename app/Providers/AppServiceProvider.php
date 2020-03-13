<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Builder;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
    
    }

    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
