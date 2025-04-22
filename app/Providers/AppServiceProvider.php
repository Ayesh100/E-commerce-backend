<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Only run this in production
        if ($this->app->environment('production')) {
            // Ensure all URLs use the right root (APP_URL) and scheme (https)
            URL::forceRootUrl(config('app.url'));
            URL::forceScheme('https');
        }
    }
}
