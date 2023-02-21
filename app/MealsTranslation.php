<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealsTranslation extends Model
{
    protected $fillable = ['title', 'description','locale', 'status'];


    public function meal()
    {
        return $this->belongsTo(\App\Meals::class, 'meal_id', 'id');
    }



}
