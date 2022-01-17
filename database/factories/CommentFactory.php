<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(\App\Comment::class, function (Faker $faker) {
    $arrayValues = ['pending', 'approved'];
    return [
        'user_id'=> rand(1,50),
        'post_id' => rand(1,50),
        'status'=> $arrayValues[rand(0,1)],
        'comment' => $faker->paragraph,
    ];
});
