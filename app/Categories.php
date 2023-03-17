<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Categories extends Model
{
    use Translatable;

    public $translatedAttributes = ['title'];
    protected $fillable = ['title','locale','slug'];


    public function translations()
    {
        return $this->hasMany(\App\CategoriesTranslation::class, 'category_id');
    }
    
    public function meals()
    {
        return $this->hasMany(\App\Meals::class, 'category_id', 'id');
    }


}
