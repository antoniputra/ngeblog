<?php

namespace Antoniputra\Ngeblog\Repositories;

use Antoniputra\Ngeblog\Models\Category;
use Illuminate\Support\Facades\Storage;

class PostMetaRepository extends BaseRepository
{
    public function __construct(Category $model)
    {
        $this->model    = $model;
        $this->fileName = 'ngeblog/post_meta.json';
    }

    public function getPostMetaFieldType()
    {
        return [
            'number' => 'Number Field',
            'text'   => 'Textarea Field',
            'date'   => 'Date Field',
        ];
    }

    public function getConfiguration()
    {
        if (!Storage::exists($this->fileName)) {
            $this->createConfig();
        }
        return $this->loadConfig();
    }

    public function saveConfiguration(array $data = [])
    {
        $fields = array_merge([$data], $this->loadConfig() ?? []);
        $this->createConfig($fields);
    }

    protected function createConfig(array $configs = [])
    {
        Storage::put($this->fileName, json_encode($configs));
    }

    protected function loadConfig()
    {
        return json_decode(Storage::get($this->fileName), true);
    }

}
