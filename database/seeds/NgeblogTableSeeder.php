<?php

use Antoniputra\Ngeblog\Models\Blog;
use Antoniputra\Ngeblog\Models\Category;
use Illuminate\Database\Seeder;

class NgeblogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userModel = config('ngeblog.user');
        $user      = app($userModel)->find(1) ?: factory($userModel)->create();

        factory(Category::class, 5)->create([
            'user_id' => $user->id,
        ])->each(function ($category) use ($user) {
            $category->blogs()->saveMany(factory(Blog::class, rand(2, 6))->make([
                'user_id' => $user->id,
            ]));
        });
    }
}
