<?php

use CodeFlix\Models\Category;
use CodeFlix\Models\Serie;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\CodeFlix\Models\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->state(\CodeFlix\Models\User::class,'admin', function (Faker $faker){

    return [
        'role' => \CodeFlix\Models\User::ROLE_ADMIN,
    ];
});

//Factory de Category
$factory->define(Category::class, function (Faker $faker) {
    return [
        'category' => $faker->unique()->word
    ];
});

//Factory de Serie
$factory->define(Serie::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'description' => $faker->sentence(10),
        'thumb' => 'thumb.jpg'
    ];
});