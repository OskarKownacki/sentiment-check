<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\NewsService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(NewsService::class, function($app){
            return new NewsService(config('services.NewsAPI.key'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
