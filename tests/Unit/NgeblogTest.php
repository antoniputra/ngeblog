<?php

namespace Antoniputra\Ngeblog\Tests\Unit;

use Antoniputra\Ngeblog\Facade as NgeblogFacade;
use Antoniputra\Ngeblog\Models\Category;
use Antoniputra\Ngeblog\Ngeblog;
use Antoniputra\Ngeblog\Tests\TestCase;

class NgeblogTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->ngeblog = new Ngeblog;
    }

    /** @test */
    public function it_has_total_category_count()
    {
        // Total category is 3, based on command:
        // php artisan ngeblog:install --with-dummy
        $this->assertEquals(3, $this->ngeblog->totalCategory());
    }

    /** @test */
    public function it_has_get_dropdown_category_method_that_returns_array_of_categories()
    {
        $categoryList = Category::orderBy('title', 'asc')->pluck('title', 'id')->toArray();

        $newCategories = array_merge([0 => '<< select category >>'], $categoryList);

        $this->assertEquals($newCategories, $this->ngeblog->getDropdownCategory());
    }

    /** @test */
    public function it_has_total_blog_count()
    {
        // Total blog is 6, based on command:
        // php artisan ngeblog:install --with-dummy
        $this->assertEquals(6, $this->ngeblog->totalBlog());
    }

    /** @test */
    public function it_has_facade_accessor()
    {
        $this->assertEquals(NgeblogFacade::totalCategory(), $this->ngeblog->totalCategory());
    }
}
