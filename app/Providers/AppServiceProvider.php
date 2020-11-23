<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('frontend.main',function($view)
        {
            $view->with('setting_website',\App\Models\Setting::first());
            $view->with('footer_post',\App\Models\Post::limit(5)->get());
        });
    }
}
