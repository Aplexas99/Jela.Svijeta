<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriesTranslation extends Model
{

    protected $fillable = ['title','locale','slug'];
    
    public function category()
    {
        return $this->belongsTo(\App\Categories::class, 'category_id', 'id');
    }
}
