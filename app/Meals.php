<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meals extends Model
{
    
    use Translatable;
    use SoftDeletes;

    public $translatedAttributes = ['title','description'];
    
    protected $fillable = ['title', 'description','locale','status'];

    public function category()
    {
        return $this->belongsTo(\App\Categories::class, 'category_id', 'id');
    }

    public function translations()
    {
       return $this->hasMany(\App\MealsTranslation::class, 'meal_id', 'id');
    }


    public function tags()
    {
        return $this->belongsToMany(\App\Tags::class, 'meal_tag', 'meal_id', 'tag_id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(\App\Ingredients::class, 'ingredient_meal', 'meal_id', 'ingredient_id');
    }



  
}
