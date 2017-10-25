<?php

namespace Antoniputra\Ngeblog;

use Antoniputra\Ngeblog\Models\Blog;
use Antoniputra\Ngeblog\Models\Category;

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
        return true;
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

    public function totalCategory()
    {
        return Category::count();
    }

    public function getLatestCategory($limit = 10)
    {
        return Category::with('blogs')
            ->withCount('blogs')
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }

    public function getDropdownCategory($value = 'id', $display = 'title')
    {
        return Category::orderBy('title', 'asc')->get()->pluck($display, $value);
    }

    public function findCategory($category_id)
    {
        return Category::with('blogs')
            ->withCount('blogs')
            ->find($category_id);
    }

    public function createCategory(array $data)
    {
        return $this->_fillable((new Category)->newInstance(), $data);
    }

    public function updateCategory($id, array $data)
    {
        $row = Category::find($id);
        if (!$row) {
            return false;
        }

        return $this->_fillable($row, $data);
    }

    public function deleteCategory($id)
    {
        return Category::destroy($id);
    }

    public function totalBlog()
    {
        return Blog::count();
    }

    public function getLatestBlog($limit = 10)
    {
        return Blog::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }

    public function getLatestBlogByCategory($category_id, $limit = 10)
    {
        return Blog::with('category')
            ->where('category_id', $category_id)
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }

    public function findBlog($blog_id)
    {
        return Blog::with('category')->find($blog_id);
    }

    public function createBlog(array $data)
    {
        return $this->_fillable((new Blog)->newInstance(), $data);
    }

    public function updateBlog($id, array $data)
    {
        $row = Blog::find($id);
        if (!$row) {
            return false;
        }

        return $this->_fillable($row, $data);
    }

    public function deleteBlog($id)
    {
        return Blog::destroy($id);
    }

    protected function _fillable($model, array $data)
    {
        $model->fill($data);

        $model->user_id = array_get(auth()->user(), 'id', 0);
        if (empty($data['slug'])) {
            $model->slug = str_slug($data['title']);
        }

        $model->save();
        return $model;
    }
}
