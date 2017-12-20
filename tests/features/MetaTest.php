<?php

namespace Antoniputra\Ngeblog\Tests\Features;

use Antoniputra\Ngeblog\Repositories\MetaRepository;
use Antoniputra\Ngeblog\Tests\TestCase;

class MetaTest extends TestCase
{
    /** @test */
    public function user_can_see_list_of_metas()
    {
        $this->visit(route('ngeblog.meta.index'))
            ->assertResponseStatus(200)
            ->seeLink('Create', route('ngeblog.meta.create'))
            ->click('Create');
    }

    /** @test */
    public function user_can_create_a_meta()
    {
        $this->visit(route('ngeblog.meta.create'))
            ->assertResponseStatus(200)
            ->select('text', 'meta_field')
            ->type('Event Location', 'meta_default_key')
            ->type('Surabaya, Indonesia', 'meta_default_value')
            ->select(1, 'category_id')
            ->press('Submit')
            ->seeInDatabase('ngeblog_metas', [
                'category_id' => 1,
                'meta_field' => 'text',
                'meta_default_key' => 'Event Location',
                'meta_default_value' => 'Surabaya, Indonesia',
            ]);
    }

    /** @test */
    public function user_can_edit_a_meta()
    {
        $this->_createMeta();

        $this->visit(route('ngeblog.meta.index'))
            ->assertResponseStatus(200)
            ->seeLink('Edit', route('ngeblog.meta.edit', 1))
            ->click('Edit')
            ->select('text', 'meta_field')
            ->type('Event Location Updated', 'meta_default_key')
            ->type('Surabaya, Indonesia', 'meta_default_value')
            ->select(1, 'category_id')
            ->press('Submit')
            ->seeInDatabase('ngeblog_metas', [
                'category_id' => 1,
                'meta_field' => 'text',
                'meta_default_key' => 'Event Location Updated',
                'meta_default_value' => 'Surabaya, Indonesia',
            ]);
    }

    /** @test */
    public function user_can_delete_a_meta()
    {
        $this->_createMeta();

        $this->visit(route('ngeblog.meta.index'))
            ->see(route('ngeblog.meta.destroy', 1));

        $this->post(route('ngeblog.meta.destroy', 1), [
            '_token'  => csrf_token(),
            '_method' => 'DELETE',
        ])
            ->assertResponseStatus(302)
            ->notSeeInDatabase('ngeblog_metas', [
                'id' => 1,
            ]);

        $this->visit(route('ngeblog.meta.index'))
            ->dontSee(route('ngeblog.meta.destroy', 1));
    }

    protected function _createMeta()
    {
        return app(MetaRepository::class)->baseCreate([
            'category_id' => 0,
            'meta_field' => 'number',
            'meta_deafult_key' => 'Ini key prend',
            'meta_deafult_value' => 'Ini value prend',
        ]);
    }
}
