<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ShortUrl;
use Illuminate\Support\Facades\Auth;

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
        // Share $urls variable globally
        View::composer('*', function ($view) {
            if (Auth::check()) {
                // Retrieve URLs for the authenticated user
                $urls = ShortUrl::where('user_id', Auth::id())->get();
                $view->with('urls', $urls);
            } else {
                $view->with('urls', collect()); // Empty collection for unauthenticated users
            }
        });
    }
}
