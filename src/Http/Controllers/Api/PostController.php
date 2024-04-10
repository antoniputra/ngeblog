<?php

namespace AntoniPutra\Ngeblog\Http\Controllers\Api;

use AntoniPutra\Ngeblog\Http\Resources\PostResource;
use AntoniPutra\Ngeblog\Models\Post;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    public function index()
    {
        $result = Post::query()
            ->select([
                'id',
                'author_id',
                'title',
                'slug',
                'first_published_at',
                'schedule_publish_at',
                'created_at',
                'updated_at',
                'deleted_at'
            ])
            ->with('tags')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return PostResource::collection($result);
    }
}
