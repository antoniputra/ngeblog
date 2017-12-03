<?php

namespace Antoniputra\Ngeblog\Repositories;

use Antoniputra\Ngeblog\Models\Blog;

class BlogRepository extends BaseRepository
{
    public function __construct(Blog $model)
    {
        $this->model = $model;
    }

    public function getPaginateLatest($limit = 10, $isSimple = false)
    {
        $blog = $this->model->with('category')
            ->orderBy('created_at', 'desc');

        return $isSimple ? $blog->simplePaginate($limit) : $blog->paginate($limit);
    }

    public function getPaginateLatestByCategory($category_id, $limit = 10)
    {
        return $this->model->with('category')
            ->where('category_id', $category_id)
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }

    public function getDetail($id)
    {
        return $this->model->with('category')->find($id);
    }

    public function getDetailBySlug($slug)
    {
        return $this->model->with('category')->where('slug', $slug)->first();
    }

    protected function _baseProcess($model, array $data)
    {
        $model->fill($data);
        $model->user_id = optional(auth()->user())->id ?: 0;

        if (empty($data['slug'])) {
            $model->slug = str_slug($data['title']);
        }

        $model->save();
        return $model;
    }
}
