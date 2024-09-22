<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\ProfilePhoto;

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
        Schema::defaultStringLength(191);

         \Carbon\Carbon::setLocale('id');

         View::composer(['layouts.app', 'layouts.dashboard-siswa',  'layouts.dashboard'], function ($view){
            $logo = ProfilePhoto::first();

            $view->with('logo', $logo);
         });
    }
}
