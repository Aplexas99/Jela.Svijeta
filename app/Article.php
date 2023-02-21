<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Article extends Model
{
    use Translatable;

    public $translatedAttributes = ['title', 'full_text'];

    protected $fillable = ['title', 'full_text'];
 
}
