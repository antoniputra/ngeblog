<?php

use Antoniputra\Ngeblog\Blog;
use Antoniputra\Ngeblog\Category;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    $title = $faker->words(3, true);
    return [
        'title' => $title,
        'slug' => str_slug($title),
        'content' => $faker->paragraph(5),
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    $title = $faker->words(rand(1, 2), true);
    return [
        'title' => $title,
        'slug' => str_slug($title),
        'description' => $faker->paragraph(2),
    ];
});
