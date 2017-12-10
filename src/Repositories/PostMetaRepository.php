<?php

namespace Antoniputra\Ngeblog\Repositories;

use Antoniputra\Ngeblog\Models\PostMeta;
use Illuminate\Support\Facades\Storage;

class PostMetaRepository extends BaseRepository
{

    public function __construct(PostMeta $model)
    {
        $this->fileName = 'ngeblog/post_meta.json';
        $this->model    = $model;
    }

    public function getPostMetaFieldType()
    {
        return [
            'number'   => 'Number Field',
            'textarea' => 'Textarea Field',
            'text'     => 'Textinput Field',
            'date'     => 'Date Field',
        ];
    }

    public function getConfiguration()
    {
        if (!Storage::exists($this->fileName)) {
            $this->createConfig();
        }
        return $this->loadConfig();
    }

    public function saveBlogPostMeta(int $blogId, $postMeta)
    {
        if ($postMeta == null) {
            return;
        }

        $postMetaConfigurations = $this->getConfiguration();
        /**
         * Delete previous post_meta data
         */
        $this->model->where('blog_id', $blogId)->delete();

        $postMetaData = [];

        foreach ($postMeta as $key => $value) {

            $index = array_search($key, array_column($postMetaConfigurations, 'meta_key'));

            $item = [
                'blog_id'    => $blogId,
                'meta_key'   => $key,
                'meta_value' => $value,
                'meta_field' => $postMetaConfigurations[$index]['meta_field'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $postMetaData[] = $item;
        }

        /**
         * create multiple post_meta data
         */
        $this->model->insert($postMetaData);
    }

    public function findByCategoryId(int $categoryId)
    {
        $configs = array_filter($this->getConfiguration(), function ($item) use ($categoryId) {
            return ($item['category_id'] == $categoryId) || ($item['category_id'] == 0);
        });
        return $configs;
    }

    public function saveConfiguration(array $data = [])
    {
        $configs = array_merge([$data], $this->getConfiguration() ?? []);
        $this->createConfig($configs);
    }

    public function updateConfiguration($id, array $data = [])
    {
        $configs      = $this->getConfiguration();
        $configs[$id] = $data;
        $this->createConfig($configs);
    }

    public function deleteConfiguration(int $index)
    {
        $configs = $this->getConfiguration();
        unset($configs[$index]);
        $this->createConfig($configs);
    }

    public function destroyConfiguration()
    {
        $this->createConfig();
    }

    protected function createConfig(array $configs = [])
    {
        if (app()->environment('testing')) {
            Storage::fake('local');
        }
        Storage::disk('local')->put($this->fileName, json_encode($configs));
    }

    protected function loadConfig()
    {
        return json_decode(Storage::get($this->fileName), true);
    }

}
