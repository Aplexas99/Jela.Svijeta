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


Route::get('/', function(Request $request){

    
    

/*
$meals = Meals::when($request->title, function($query) use ($request) {
    $query->with(['tags'])->where('title', 'LIKE', "%$request->title%");
})->when($request->locale, function($query) use ($request) {
    $query->with(['ingredients'])->where('locale', '=', $request->locale);
})->orderBy('id')->get();
*/


$withParams=[];

if(
(str_contains($request,'tags')==1) &&
(str_contains($request,'ingredients')==1) && 
(str_contains($request,'category')==1)
){
    $withParams=['tags','ingredients','category'];
}
elseif(
(str_contains($request,'tags')==1) &&
(str_contains($request,'ingredients')==1)&&
(str_contains($request,'category')==0)
){
    $withParams=['tags','ingredients'];
}
elseif(
(str_contains($request,'tags')==1) &&
(str_contains($request,'ingredients')==0)&&
(str_contains($request,'category')==1)
){
    $withParams=['tags','category'];
}
elseif(
(str_contains($request,'tags')==0) &&
(str_contains($request,'ingredients')==1)&&
(str_contains($request,'category')==1)
){
    $withParams=['ingredients','category'];
}
elseif(
(str_contains($request,'tags')==1) &&
(str_contains($request,'ingredients')==0)&&
(str_contains($request,'category')==0)
){
    $withParams=['tags'];
}
elseif(
(str_contains($request,'tags')==0) &&
(str_contains($request,'ingredients')==1)&&
(str_contains($request,'category')==0)
){
    $withParams=['ingredients'];
}
elseif(
(str_contains($request,'tags')==0) &&
(str_contains($request,'ingredients')==0)&&
(str_contains($request,'category')==1)
){
    $withParams=['category'];
}
else{
    $withParams=['tags','ingredients','category'];
}



$meals= Meals::with($withParams)
->where('category_id', '=', $request->category??null)
    ->paginate($request->per_page??3);
$meals->links();


});


Route::get('/filter', 'MealsFilterController@filter')->name('filter');

//make route to set locale and call MealsFilterController@filter function
Route::get('/{locale}', function($locale){
    App::setLocale($locale);
    return redirect()->route('filter');
});
/*
Route::get('{locale}', function($locale) {
    app()->setLocale($locale);
  
    $meals = Meals::all();
  
    return view('welcome',compact('meals'));
 });
*/