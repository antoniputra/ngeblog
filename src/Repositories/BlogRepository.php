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
        $blog = $this->model->filterable()->with('category')
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
        return $this->model->with(['category', 'blogmetas'])->find($id);
    }

    public function getDetailBySlug($slug)
    {
        return $this->model->with('category')->where('slug', $slug)->first();
    }

    protected function _baseProcess($model, array $data, $isEdit = false)
    {
        return \DB::transaction(function () use ($model, $data, $isEdit) {
            $model->fill($data);
            $model->user_id = optional(auth()->user())->id ?: 0;

            if (empty($data['slug'])) {
                $model->slug = str_slug($data['title']);
            }

            $model->save();

            if (!empty($data['meta_id'])) {

                if ($isEdit) {
                    $model->blogmetas()->delete();
                }

                $this->_appendMeta($model, $data);
            }

            return $model;
        });
    }

    protected function _appendMeta($model, array $data)
    {
        $result = [];
        foreach ($data['meta_id'] as $key => $mid) {
            array_push($result, [
                'order' => $key,
                'meta_id' => $data['meta_id'][$key],
                'meta_field' => $data['meta_field'][$key],
                'meta_key' => $data['meta_key'][$key],
                'meta_value' => $data['meta_value'][$key],
            ]);
        }
        // dd($result);
        $model->blogmetas()->createMany($result);
    }
}
