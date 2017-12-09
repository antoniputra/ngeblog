<?php

namespace Antoniputra\Ngeblog\Tests\Unit\Models;

use Antoniputra\Ngeblog\Models\Blog;
use Antoniputra\Ngeblog\Models\Category;
use Antoniputra\Ngeblog\Models\User;
use Antoniputra\Ngeblog\Tests\TestCase;

class BlogTest extends TestCase
{

    /** @test */
    public function a_blog_belongs_to_a_category()
    {
        $user = User::find(1);

        $category = factory(Category::class)->create([
            'user_id' => $user->id,
        ]);

        $blog = factory(Blog::class)->create([
            'category_id' => $category->id,
            'user_id'     => $user->id,
        ]);

        $this->assertInstanceOf(Category::class, $blog->category);
        $this->assertEquals($blog->category->id, $category->id);
    }

    /** @test */
    public function a_blog_belongs_to_a_user()
    {
        $user = User::find(1);

        $blog = factory(Blog::class)->create([
            'user_id'     => $user->id,
            'category_id' => factory(Category::class)->create([
                'user_id' => $user->id,
            ]),
        ]);

        $this->assertInstanceOf(User::class, $blog->user);
        $this->assertEquals($blog->user->id, $user->id);
    }
}
