<?php

namespace App\Providers;

use App\Services\CloudinaryService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CloudinaryService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*TESTING*/
       URL::forceScheme('https');


        // 10 listing image uploads per minute per user
        RateLimiter::for('image-upload', function ($request) {
            return Limit::perMinute(10)->by($request->user()?->id ?: $request->ip());
        });

        // 5 profile uploads per hour per user
        RateLimiter::for('profile-upload', function ($request) {
            return Limit::perHour(5)->by($request->user()?->id ?: $request->ip());
        });
    }


}
