<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function (Faker $faker) {
    $user = \App\User::all()->random();
    return [
        'user_id' => $user->id,
        'content' => $faker->text()
    ];
});

$factory->define(App\Comment::class, function (Faker $faker) {
    $user = \App\User::all()->random();
    $post = \App\Post::all()->random();
    return [
        'user_id' => $user->id,
        'post_id' => $post->id,
        'comment' => $faker->text()
    ];
});

