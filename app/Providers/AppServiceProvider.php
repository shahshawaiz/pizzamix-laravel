<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\Models;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer('layouts.shared.header', function($view)
        {
            $checkouts = Models\Checkout::all();
            $view->with('checkouts', $checkouts);
        });        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
