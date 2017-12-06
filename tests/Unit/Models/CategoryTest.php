<?php

namespace Antoniputra\Ngeblog\Tests\Unit\Models;

use Antoniputra\Ngeblog\Models\Blog;
use Antoniputra\Ngeblog\Models\Category;
use Antoniputra\Ngeblog\Models\User;
use Antoniputra\Ngeblog\Tests\TestCase;
use Illuminate\Support\Collection;

class CategoryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->installCommand();
    }

    /** @test */
    public function a_category_belongs_to_a_user()
    {
        $user = User::find(1);

        $category = factory(Category::class)->create([
            'user_id' => $user->id,
        ]);

        $this->assertInstanceOf(User::class, $category->user);
        $this->assertEquals($category->user->id, $user->id);
    }

    /** @test */
    public function a_category_has_many_blogs()
    {
        $user = User::find(1);

        $category = factory(Category::class)->create([
            'user_id' => $user->id,
        ]);

        $blog = factory(Blog::class, 2)->create([
            'category_id' => $category->id,
            'user_id'     => $user->id,
        ]);

        $this->assertInstanceOf(Collection::class, $category->blogs);
        $this->assertCount(2, $category->blogs);
        $this->assertInstanceOf(Blog::class, $category->blogs->first());
    }
}
