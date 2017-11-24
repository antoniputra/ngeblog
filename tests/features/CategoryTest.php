<?php

namespace Antoniputra\Ngeblog\Tests\Features;

use Antoniputra\Ngeblog\Tests\FeatureTestCase;

class CategoryTest extends FeatureTestCase
{
    /** @test */
    public function user_can_view_a_category()
    {
        $this->get(route('ngeblog.category.index'))
        	->assertStatus(200)
        	->assertSee('Category Index');
    }
}
