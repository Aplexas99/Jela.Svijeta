<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TagResource;
use App\Http\Resources\IngredientResource;
use App\Http\Resources\CategoryResource;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
        ];

        if(str_contains($request->with,'category')){
            $data['category']=new CategoryResource($this->category);
        }
        if(str_contains($request->with,'tags')){
            $data['tags']=TagResource::collection($this->tags);
        }
        if(str_contains($request->with,'ingredients')){
            $data['ingredients']=IngredientResource::collection($this->ingredients);
        }

        return $data;
}
}
