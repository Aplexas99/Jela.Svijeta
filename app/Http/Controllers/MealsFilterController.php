<?php

namespace App\Http\Controllers;


use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

use Illuminate\Http\Request;
use App\Meals;
use App\MealsTranslation;
use App\Categories;
use App\Tags;
use App;


class MealsFilterController extends Controller
{
    
    //get request from URL and filter meals based on request
    public function filter(Request $request)
    {
        $meals= Meals::with("tags")
        ->where('category_id', '=', $request->category??null)
            ->paginate($request->per_page??1);
        $meals->links();
        

      

        return view('welcome', compact('meals','request'));
    }

   
}
