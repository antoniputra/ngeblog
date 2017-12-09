<?php

namespace Antoniputra\Ngeblog\Tests\Features;

use Antoniputra\Ngeblog\Tests\TestCase;

class PostMetaTest extends TestCase
{

    /** @test */
    public function user_can_list_of_all_configuration()
    {
        $this->visit(route('ngeblog.postmeta.index'))
            ->assertResponseStatus(200)
            ->seeLink('Create', route('ngeblog.postmeta.create'))
            ->click('Create');
    }

    /** @test */
    public function user_can_create_delete_a_configuration()
    {
        $this->createPostMetaConfiguration();
        $this->post(route('ngeblog.postmeta.destroy', 0), [
            '_token'  => csrf_token(),
            '_method' => 'DELETE',
        ])
            ->assertResponseStatus(302)
            ->followRedirects()
            ->dontSee('first_meta_key');
    }

    /** @test */
    public function user_can_create_edit_a_configuration()
    {
        $this->createPostMetaConfiguration();
        $this->visit(route('ngeblog.postmeta.index'))
            ->see('first_meta_key');

        $this->visit(route('ngeblog.postmeta.edit', 0))
            ->see('first_meta_key')
            ->type('first_meta_key_updated', 'meta_key')
            ->press('Submit')
            ->followRedirects()
            ->see('first_meta_key_updated');
    }

}
