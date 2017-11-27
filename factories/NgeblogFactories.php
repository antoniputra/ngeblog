<?php

use Antoniputra\Ngeblog\Models\Blog;
use Antoniputra\Ngeblog\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $title = $faker->words(rand(2, 4), true);
    return [
        'title' => $title,
        'slug' => str_slug($title),
        'description' => $faker->paragraph(2),
    ];
});

$factory->define(Blog::class, function (Faker $faker) {
    $title = $faker->words(rand(3, 5), true);
    return [
        'title' => $title,
        'slug' => str_slug($title),
        'content' => $faker->paragraph(5),
    ];
});
