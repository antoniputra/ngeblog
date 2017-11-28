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
        $user = app($userModel)->find(1) ?: $this->_createUser();

        factory(Category::class, 3)->create([
            'user_id' => $user->id,
        ])->each(function ($category) use ($user) {
            $category->blogs()->saveMany(factory(Blog::class, 2)->make([
                'user_id' => $user->id,
            ]));
        });
    }

    protected function _createUser()
    {
        $userModel = app(config('ngeblog.user'));
        $userModel->name = 'Ngeblog';
        $userModel->email = 'ngeblog@example.com';
        $userModel->password = bcrypt('secret');
        $userModel->remember_token = str_random(10);
        $userModel->save();
        return $userModel;
    }
}
