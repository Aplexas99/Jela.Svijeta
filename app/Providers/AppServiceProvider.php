<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;


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
    public function boot(Request $request)
    {
        if(!Session::has('locale')) {
            Carbon::setLocale('en');
            app()->setLocale('en');
   
        }
        setlocale(LC_ALL, config('app.locale') . '.utf8');
        Carbon::setLocale(config('app.locale'));
    }
}
