<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'image' => $faker->image,
        'name' => $faker->word,
        'description' => $faker->paragraph,
        'price' => $faker->numberBetween($min = 1000, $max = 500000),
    ];
});
