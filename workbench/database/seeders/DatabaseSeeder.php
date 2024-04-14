<?php

use AntoniPutra\Ngeblog\Models\Post;
use AntoniPutra\Ngeblog\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Workbench\App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Demo User',
            'email' => 'demo@example.com',
            'password' => bcrypt('password'),
        ]);

        for ($i=0; $i < 10; $i++) {
            $title = fake()->words(rand(2, 3), true);
            Tag::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'is_visible' => fake()->boolean(70),
                'description' => fake()->paragraph(),
            ]);
        }

        for ($i=0; $i < 20; $i++) { 
            $title = fake()->sentence();
            $post = Post::create([
                'author_id' => $user->id,
                'title' => $title,
                'slug' => Str::slug($title),
                'is_visible' => fake()->boolean(70),
                'editor_type' => fake()->randomElement([Post::EDITOR_TYPE_MARKDOWN, Post::EDITOR_TYPE_RICHTEXT]),
                'excerpt' => fake()->paragraphs(rand(1, 2), true),
                'content' => fake()->paragraphs(rand(3, 6), true),
            ]);

            $post->tags()->attach(Tag::query()->inRandomOrder()->take(rand(2,4))->get());
        }
    }
}
