<?php

use AntoniPutra\Ngeblog\Models\Post;
use Illuminate\Database\Seeder;
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

        Post::factory(20)->create([
            'author_id' => $user->id,
        ]);
    }
}
