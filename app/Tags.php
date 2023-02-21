<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use App\Meals;

class Tags extends Model
{
    
    use Translatable;

    public $translatedAttributes = ['title'];
    protected $fillable = ['slug'];

    public function meals()
    {
        return $this->belongsToMany(Meals::class, 'meal_tag', 'tag_id', 'meal_id');
    }

    public function translations()
    {
        return $this->hasMany(\App\TagsTranslation::class, 'tag_id', 'id');
    }
}
