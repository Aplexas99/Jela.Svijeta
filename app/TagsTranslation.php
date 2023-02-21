<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagsTranslation extends Model
{
    protected $fillable = ['title','locale'];   

    public function tag()
    {
        return $this->belongsTo(App\Tags::class, 'tag_id', 'id');
    }
}
