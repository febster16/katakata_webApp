<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

$factory->define(Post::class, function (Faker $faker) {
    return [

        'user_id' => factory('App\User'),
        'title' => $faker->sentence,
        'post_image'=> '',
        'body' => $faker->paragraph,
        'category_id' => rand(1,9),
        'status' => 'active',
    ];
});
