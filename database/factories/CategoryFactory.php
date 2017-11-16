<?php

use CodeFlix\Models\Category;
use Faker\Generator as Faker;

//Factory de Category
$factory->define(Category::class, function (Faker $faker) {
    return [
        'category' => $faker->unique()->word
    ];
});