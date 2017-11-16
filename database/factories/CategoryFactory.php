<?php

use CodeFlix\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return ['category' => $faker->unique()->title];
});
