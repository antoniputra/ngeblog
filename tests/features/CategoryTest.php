<?php

namespace Antoniputra\Ngeblog\Tests\Features;

use Antoniputra\Ngeblog\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_see_list_of_all_category_and_create_link()
    {
        $this->visit(route('ngeblog.category.index'))
            ->assertResponseStatus(200)
            ->seeLink('Create', route('ngeblog.category.create'))
            ->click('Create');
    }

    /** @test */
    public function user_can_create_a_category()
    {
        $this->visit(route('ngeblog.category.create'))
            ->assertResponseStatus(200)
            ->type('Awesome Name', 'title')
            ->type('Awesome Description', 'description')
            ->press('Submit')
            ->seeInDatabase('ngeblog_categories', [
                'title'       => 'Awesome Name',
                'description' => 'Awesome Description',
            ]);
    }

    /** @test */
    public function user_can_edit_a_category()
    {
        $this->visit(route('ngeblog.category.index'))
            ->assertResponseStatus(200)
            ->seeLink('Edit', route('ngeblog.category.edit', 1))
            ->click('Edit')
            ->type('Update Name', 'title')
            ->type('Update Description', 'description')
            ->press('Submit')
            ->seeInDatabase('ngeblog_categories', [
                'title'       => 'Update Name',
                'description' => 'Update Description',
            ]);
    }

    /** @test */
    public function user_can_delete_a_category()
    {
        $this->visit(route('ngeblog.category.index'))
            ->see(route('ngeblog.category.destroy', 1));

        $this->post(route('ngeblog.category.destroy', 1), [
            '_token'  => csrf_token(),
            '_method' => 'DELETE',
        ])
            ->assertResponseStatus(302)
            ->notSeeInDatabase('ngeblog_categories', [
                'id' => 1,
            ]);

        $this->visit(route('ngeblog.category.index'))
            ->dontSee(route('ngeblog.category.destroy', 1));
    }
}
