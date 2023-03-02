<?php 

namespace App\Http\Middleware;


use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class Language
{
    public function handle(Request $request, Closure $next)
    {
        if(session()->has('locale')){
            Carbon::setLocale(session()->get('locale'));
            app()->setLocale(session()->get('locale'));
        }
        else{
            Carbon::setLocale('en');
            app()->setLocale('en');
        }
        return $next($request);
    }
}