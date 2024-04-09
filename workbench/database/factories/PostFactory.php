<?php

namespace Workbench\Database\Factories;

use AntoniPutra\Ngeblog\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $title = fake()->sentence();
        return [
            'author_id' => null,
            'title' => $title,
            'slug' => Str::slug($title),
            'is_visible' => fake()->boolean(60),
            'description' => fake()->paragraph(),
            'content' => fake()->paragraphs(rand(3, 6), true),
        ];
    }
}
