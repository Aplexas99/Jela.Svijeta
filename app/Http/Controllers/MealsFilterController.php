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
        if($request->lang != null){
            app()->setLocale($request->lang);
        } else {
            app()->setLocale('en');
        }

        $withParams=$this->makeWithParameters($request);

        $meals=$this->filterByCategoriesAndTags($request,$withParams);

        $meals=$this->addStatus($request,$meals);

        

        $meals= new MealResourceCollection($meals);
    
        return view('welcome', compact('meals','request','withParams'));
    }


    public function addStatus(Request $request, $meals){
           
        $diffTime= $request->diff_time??'0 days ago';
  
        $diffTimeCarbon= Carbon::createFromTimestamp($diffTime)->format('Y-m-d H:i:s');

        $diffTime=strtotime($request->diff_time??'0 days ago');
        foreach ($meals as $meal) {
            
            if ($meal->deleted_at < $diffTimeCarbon && $meal->deleted_at != null) {
                $meal->status = 'Deleted';
            }  else{
                $meal->status = $diffTimeCarbon < $meal->updated_at ? 'Updated' : 'Created';
            }
        }
        return $meals;
    }
    public function makeWithParameters(Request $request){
        $withParams=[];

        if(str_contains($request->with,'tags')==1)
        { 
            $withParams[]='tags';
        }
        if(str_contains($request->with,'ingredients')==1)
        {
            $withParams[]='ingredients';
        }
        if(str_contains($request->with,'category')==1)
        {
            $withParams[]='category';
        }
        return $withParams;
    }

    public function filterByCategoriesAndTags(Request $request,$withParams){
        
        $default_per_page=5;
        $diffTime= $request->diff_time??'0 days ago';
        $timeCarbon= Carbon::createFromTimestamp($diffTime)->format('Y-m-d H:i:s');


        $tagIds=[];
        if($request->tags != null){
            $tagIds=explode(',',$request->tags);
        }
        //in case none of the tags is selected
        else{
            $tagIds=Tags::pluck('id')->toArray();
        }
        

        //if request has category parameter equal to null
        if($request->category =='null'){
            $meals= Meals::with($withParams)
            ->where('category_id', '=', null)
            ->whereHas('tags', function($query) use ($request, $tagIds){
                $query->whereIn('tag_id', $tagIds);
            })
            ->when($request->diff_time>0, function ($query)use($request,$timeCarbon){
                return $query->withTrashed()
                ->whereDate('created_at','<',$timeCarbon);
            })
            ->paginate($request->per_page??$default_per_page);
            $meals->links();
        }
        //if parameter category is number
        else if($request->category != null && $request->category != '!null'){
            $meals= Meals::with($withParams)
            ->where('category_id', '=', $request->category)
            ->whereHas('tags', function($query) use ($request, $tagIds){
                $query->whereIn('tag_id', $tagIds);
            })
            ->when($request->diff_time>0, function ($query)use($request,$timeCarbon){
                return $query->withTrashed()
                ->whereDate('created_at','<',$timeCarbon);
            })
            ->paginate($request->per_page??$default_per_page);
            $meals->links();
        } 
        //if parameter catgory is !null
        else if($request->category == '!null'){

            $meals= Meals::with($withParams)
            ->where('category_id', '!=', null)
            ->whereHas('tags', function($query) use ($request, $tagIds){
                $query->whereIn('tag_id', $tagIds);
            })
            ->when($request->diff_time>0, function ($query)use($request,$timeCarbon){
                return $query->withTrashed()
                ->whereDate('created_at','<',$timeCarbon);
            })
            ->paginate($request->per_page??$default_per_page);
            $meals->links();
        }
        //if request doesn't have category parameter don't filter by category
        else{
         
          $meals= Meals::with($withParams)
          ->when($request->diff_time>0, function ($query)use($request,$timeCarbon){
            return $query->withTrashed()
            ->whereDate('created_at','<',$timeCarbon);
        })
                ->whereHas('tags', function($query) use ($request, $tagIds){
                    $query->whereIn('tag_id', $tagIds);
                })
            ->paginate($request->per_page??$default_per_page);
            $meals->links();
        }
        return $meals;

       }

}


