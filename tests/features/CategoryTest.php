<?php

namespace Antoniputra\Ngeblog\Tests\Features;

use Antoniputra\Ngeblog\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function user_can_view_list_all_category()
    {
        $this->get(route('ngeblog.category.index'))
            ->assertStatus(200)
            ->assertSee('Category Index');
    }

    /** @test */
    public function user_can_create_a_category()
    {
        $this->get(route('ngeblog.category.create'))
            ->assertStatus(200)
            ->assertSee('Create Category');
        // ->type('New Awesome Name', 'name');
    }
}
