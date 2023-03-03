<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Meals;
use App\MealsTranslation;
use App\Categories;
use App\Tags;



Route::get('/filter', 'MealsFilterController@filter');

Route::get('/', function(){
    return redirect()->action('MealsFilterController@filter');
});
