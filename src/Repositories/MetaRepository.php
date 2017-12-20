<?php

namespace Antoniputra\Ngeblog\Repositories;

use Antoniputra\Ngeblog\Models\Meta;

class MetaRepository extends BaseRepository
{
    public function __construct(Meta $model)
    {
        $this->model = $model;
    }

    public function getPaginateLatest($limit = 10)
    {
        return $this->model->with('category')
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }

    public function getAllFilterable()
    {
        $category_id = request('category_id') ?: 0;
        return $this->model->where('category_id', $category_id)->get();
    }

    public function getFieldsType()
    {
        return [
            'number' => 'Number Field',
            'textarea' => 'Textarea Field',
            'text' => 'Text input Field',
            'date' => 'Date Field',
        ];
    }
}
