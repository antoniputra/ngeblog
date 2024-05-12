<?php

namespace AntoniPutra\Ngeblog;

use AntoniPutra\Ngeblog\Models\Post;

class Ngeblog
{
    public static function frontendConfig(): array
    {
        $path = str(config('ngeblog.path', 'ngeblog'))->start('/');
        return [
            'fullPath' => config('app.url') . $path,
            'path' => $path,
        ];
    }

    public function getPostsAsPaginated($perPage = 15, array $filters = [], array $sort = [])
    {
        return Post::query()
            ->with('tags')
            ->filterable($filters)
            ->sortable($sort, defaultSort: function ($q) {
                $q->latest();
            })
            ->paginate($perPage);
    }
}
