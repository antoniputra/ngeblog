<?php

use AntoniPutra\Ngeblog\Models\Post;
use AntoniPutra\Ngeblog\Models\Postmeta;
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
            $date = fake()->dateTimeBetween('-1 months');
            Tag::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'is_visible' => fake()->boolean(70),
                'description' => fake()->paragraph(),
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        for ($i=0; $i < 20; $i++) { 
            $title = fake()->sentence();
            $date = fake()->dateTimeBetween('-1 months');
            $post = Post::create([
                'author_id' => $user->id,
                'title' => $title,
                'slug' => Str::slug($title),
                'is_visible' => fake()->boolean(70),
                // 'content_type' => fake()->randomElement([Post::CONTENT_TYPE_MARKDOWN, Post::CONTENT_TYPE_RICHTEXT]),
                'excerpt' => fake()->paragraphs(rand(1, 2), true),
                'content' => fake()->paragraphs(rand(3, 6), true),
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            // * Randomly put meta on post
            if (rand(0, 1)) {
                $post->metas()->create([
                    'field_type' => Postmeta::FIELD_TYPE_TEXT,
                    'key' => 'co_author',
                    'label' => 'Co Author',
                    'value' => fake()->name(),
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }

            $post->tags()->attach(Tag::query()->inRandomOrder()->take(rand(2,4))->get());
        }
    }
}
