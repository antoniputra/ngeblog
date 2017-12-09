<?php

namespace Antoniputra\Ngeblog\Repositories;

use Antoniputra\Ngeblog\Models\Category;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getPaginateLatest($limit = 10)
    {
        return $this->model->with('blogs')
            ->withCount('blogs')
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }

    public function getDetail($id, $showBlog = true)
    {
        $model = $this->model;
        if ($showBlog) {
            $model->with('blogs');
        }
        return $model->withCount('blogs')
            ->find($id);
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
