<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientsTranslation extends Model
{
    protected $fillable = ['title','locale'];

    public function ingredient()
    {
        return $this->belongsTo(App\Ingredients::class, 'ingredient_id', 'id');
    }

    
}
