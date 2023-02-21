<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use App\Meals;

class Ingredients extends Model
{
    
    use Translatable;

    public $translatedAttributes = ['title'];
    protected $fillable = ['slug'];

    public function meals()
    {
        return $this->belongsToMany(Meals::class, 'ingredient_meal', 'ingredient_id', 'meal_id');
    }

    public function translations()
    {
        return $this->hasMany(\App\IngredientsTranslation::class, 'ingredient_id', 'id');
    }
}
