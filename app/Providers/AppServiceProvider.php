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
        \App\BukuBank::observe(\App\Observers\BukuBankObserver::class);
        if(env('APP_ENV') === 'production')
        {
            \URL::forceScheme('https');
        }
    }
}
