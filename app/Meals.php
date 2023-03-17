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

    public function scopeCategoryIsNull($query)
    {
        return $query->whereNull('category_id');
    }

    public function scopeCategoryIsNotNull($query)
    {
        return $query->whereNotNull('category_id');
    }

    public function scopeCategoryById($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
  
    public function scopeFilterByCategory($query, $categoryId)
{
    if ($categoryId=='null') {
        $query->categoryIsNull();
    } elseif ($categoryId == '!null') {
        $query->categoryIsNotNull();
    } elseif(empty($categoryId)){
        return $query;
    } 
    else {
        $query->categoryById($categoryId);
    } 
    return $query;
}

public function scopeFilterByTagIds($query, $tagIds)
{
    if($tagIds == null){
        return $query;
    }
    
    foreach($tagIds as $tagId){
        $query->whereHas('tags', function($q) use ($tagId) {
            $q->where('tags.id', $tagId);
        });
}
    
    $query->whereDoesntHave('tags', function($q) use ($tagIds) {
        $q->whereNotIn('tags.id', $tagIds);
    });
    
    return $query;

}

public function scopeReturnWithTrashed($query, $diff_time,$timeCarbon)
{
    if($diff_time<=0 || $diff_time=='null' || empty($diff_time)){
        return $query->withoutTrashed();
    } else {
        $query->withTrashed()
        ->whereDate('created_at','<',$timeCarbon);
        return $query;
    }

}
}