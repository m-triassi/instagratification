<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $url = substr(get_headers('https://source.unsplash.com/random')[10], 10, 140);

    return [
        'caption' => $faker->paragraph(1),
        'likes' => rand(1, 5000),
        'media' => $url,
    ];
});
