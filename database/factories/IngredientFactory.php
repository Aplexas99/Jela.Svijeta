<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ingredients;
use Faker\Generator as Faker;

$factory->define(Ingredients::class, function (Faker $faker) {
   static $iorder = 1;
    
    return [
        'slug' => "ingredient-".$iorder++,
    ];
});
