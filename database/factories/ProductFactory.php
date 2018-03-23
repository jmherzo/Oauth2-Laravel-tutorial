<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'description'=>$faker->sentence($nbWords = 8, $variableNbWords = true),
        'code'=>$faker->isbn10,
        'buyPrice'=>$faker->randomFloat,
        'sellPrice'=>$faker->randomFloat
    ];
});
