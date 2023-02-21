<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Categories;
use Faker\Generator as Faker;

$factory->define(Categories::class, function (Faker $faker) {   

    static $order = 1;
    return [
        'slug' => "category-" . $order++,
    ];
});
