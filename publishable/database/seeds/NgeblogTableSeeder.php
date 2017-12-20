<?php

use Antoniputra\Ngeblog\Models\Blog;
use Antoniputra\Ngeblog\Models\Category;
use Antoniputra\Ngeblog\Models\Meta;
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
        $user = app($userModel)->find(1) ?: $this->_createDefaultUser();

        $eventCategory = factory(Category::class)->create([
            'user_id' => $user->id,
            'title' => 'Events',
            'slug' => 'events',
            'description' => 'Category that contains list of event',
        ]);

        $this->_createDefaultMeta($eventCategory->id);


        // insert dummy data
        factory(Category::class, 2)->create([
            'user_id' => $user->id,
        ])->each(function ($category) use ($user) {
            $category->blogs()->saveMany(factory(Blog::class, 2)->make([
                'user_id' => $user->id,
            ]));
        });
    }

    protected function _createDefaultUser()
    {
        $userModel = app(config('ngeblog.user'));
        $userModel->name = 'Ngeblog';
        $userModel->email = 'ngeblog@example.com';
        $userModel->password = bcrypt('secret');
        $userModel->remember_token = str_random(10);
        $userModel->save();
        return $userModel;
    }

    protected function _createDefaultMeta($category_id)
    {
        $datas = [
            [
                'category_id' => $category_id,
                'meta_field' => 'number',
                'meta_default_key' => 'Max Participants',
                'meta_default_value' => 50,
            ],
            [
                'category_id' => $category_id,
                'meta_field' => 'text',
                'meta_default_key' => 'Event Location',
                'meta_default_value' => 'Simo Gunung 60181 Surabaya, Indonesia',
            ],
            [
                'category_id' => $category_id,
                'meta_field' => 'date',
                'meta_default_key' => 'Start at',
                'meta_default_value' => null,
            ],
            [
                'category_id' => $category_id,
                'meta_field' => 'date',
                'meta_default_key' => 'End at',
                'meta_default_value' => null,
            ],
        ];

        foreach ($datas as $key => $d) {
            Meta::create($d);
        }
    }
}
