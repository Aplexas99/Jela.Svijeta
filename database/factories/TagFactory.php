<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tags;
use Faker\Generator as Faker;

$factory->define(Tags::class, function (Faker $faker) {
    
    static $tagorder = 1;

    return [
        'slug' => "tag-" . $tagorder++,

    ];
});
