<?php

namespace Antoniputra\Ngeblog;

use Antoniputra\Ngeblog\Models\Blog;
use Antoniputra\Ngeblog\Models\Category;
use Antoniputra\Ngeblog\Repositories\BlogRepository;
use Antoniputra\Ngeblog\Repositories\CategoryRepository;
use Closure;

class Ngeblog
{
    /**
     * The callback that should be used to authenticate Ngeblog Users.
     *
     * @var \Closure
     */
    public static $authUsing;

    /**
     * Determine if the given request can access the Ngeblog Admin
     *
     * @param  \Illuminate\Http\Request $request
     * @return bool
     */
    public static function check($request)
    {
        return (static::$authUsing ?: function () {
            return app()->environment('local') || app()->environment('testing');
        })($request);
    }

    /**
     * Set the callback that should be used to authenticate Ngeblog users.
     *
     * @param  \Closure  $callback
     * @return static
     */
    public static function auth(Closure $callback)
    {
        static::$authUsing = $callback;

        return new static;
    }

    /**
     * Get category Repository
     *
     * @return \Antoniputra\Ngeblog\Repositories\CategoryRepository
     */
    public function category()
    {
        return app(CategoryRepository::class);
    }

    /**
     * Get blog Repository
     *
     * @return \Antoniputra\Ngeblog\Repositories\BlogRepository
     */
    public function blog()
    {
        return app(BlogRepository::class);
    }

    public function totalCategory()
    {
        return Category::count();
    }

    public function getDropdownCategory($value = 'id', $display = 'title')
    {
        $cats    = Category::orderBy('title', 'asc')->get()->pluck($display, $value)->toArray();
        $cats[0] = '<< select category >>';
        asort($cats);
        return $cats;
    }

    public function totalBlog()
    {
        return Blog::count();
    }
}
