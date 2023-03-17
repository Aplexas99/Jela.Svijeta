<?php

namespace App\Http\Controllers;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Meals;
use App\MealsTranslation;
use App\Categories;
use App\Tags;
use App;
use App\Http\Resources\MealResourceCollection;
use App\Http\Resources\MealResource;
use Carbon\Carbon;


class MealsFilterController extends Controller
{
    public function filter(Request $request)
    {
        if($request->lang != null) {
            app()->setLocale($request->lang);
        } else {
            app()->setLocale('en');
        }

        $diffTime = $request->diff_time ?? -1;
        $timeCarbon= Carbon::createFromTimestamp($diffTime)->format('Y-m-d H:i:s');


        $withParams = $this->makeWithParameters($request);

        $meals = $this->filterMeals($request, $withParams, $diffTime, $timeCarbon);

        $meals = $this->addStatus($request, $meals, $diffTime, $timeCarbon);

        $meals = new MealResourceCollection($meals);
    
        
        $options = JSON_PRETTY_PRINTS;
       
        return response()->json($meals, 200, [], $options);
    }


    public function addStatus(Request $request, $meals, $diff_time, $timeCarbon)
    {

        if($diff_time < 0) {
            return $meals;
        }

        foreach ($meals as $meal) 
        {
            
            if ($meal->deleted_at < $timeCarbon && $meal->deleted_at != null) {
                $meal->status = 'Deleted';
            }   else{
                $meal->status = ($meal->created_at < $meal->updated_at) && 
                    ($timeCarbon < $meal->updated_at) ? 
                        'Updated' : 'Created';
            }
        }

        return $meals;
    }

    public function makeWithParameters(Request $request)
    {
        $request->with == null ? $withParams = []:
        $withParams = explode(',', $request->with);

        return $withParams;
    }

    public function filterMeals(Request $request, $withParams, $diff_time, $timeCarbon)
    {
        
        $default_per_page = 5;

        $tagIds = [];
        
        if($request->tags != null) {
            $tagIds=explode(',' , $request->tags);
        }
         
        $meals= Meals::with($withParams)
            ->returnWithTrashed($diff_time, $timeCarbon)
            ->filterByCategory($request->category)
            ->filterByTagIds($tagIds)
            ->paginate($request->per_page?? $default_per_page);
        
        $meals->links();
        
        return $meals;
    }

}

