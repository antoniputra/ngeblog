<?php

namespace Antoniputra\Ngeblog\Tests\Features;

use Antoniputra\Ngeblog\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BlogTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->installCommand();
    }

    /** @test */
    public function user_can_list_of_all_blogs()
    {
        $this->visit(route('ngeblog.blog.index'))
            ->assertResponseStatus(200)
            ->seeLink('Create', route('ngeblog.blog.create'))
            ->click('Create');
    }

    /** @test */
    public function user_can_create_a_blog()
    {
        $this->visit(route('ngeblog.blog.create'))
            ->assertResponseStatus(200)
            ->type('Awesome name', 'title')
            ->select(1, 'category_id')
            ->see('category_id')
            ->type('Awesome content', 'content')
            ->press('Submit')
            ->seeInDatabase('ngeblog_blogs', [
                'title' => 'Awesome name',
                'category_id' => 1,
                'content' => 'Awesome content',
            ]);
    }

    /** @test */
    public function user_can_edit_a_blog()
    {
        $this->visit(route('ngeblog.blog.edit', 1))
            ->assertResponseStatus(200)
            ->type('Updated name', 'title')
            ->select(2, 'category_id')
            ->see('category_id')
            ->type('Updated content', 'content')
            ->press('Submit')
            ->seeInDatabase('ngeblog_blogs', [
                'title' => 'Updated name',
                'category_id' => 2,
                'content' => 'Updated content',
            ]);
    }
}
