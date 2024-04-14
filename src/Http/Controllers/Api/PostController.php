<?php

namespace AntoniPutra\Ngeblog\Http\Controllers\Api;

use AntoniPutra\Ngeblog\Http\Resources\PostResource;
use AntoniPutra\Ngeblog\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;

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
                'is_visible',
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

    public function show(Post $post)
    {
        sleep(2);
        return PostResource::make($post)->resolve();
    }

    public function store(Request $request)
    {
        sleep(1);
        $post = $this->createOrUpdate(new Post, $request);
        return PostResource::make($post)->resolve();
    }
    
    public function update(Post $post, Request $request)
    {
        sleep(1);
        $post = $this->createOrUpdate($post, $request);
        return PostResource::make($post)->resolve();
    }

    public function toggleVisibility(Post $post)
    {
        $post->toggleVisibility();
        return PostResource::make($post)->resolve();
    }

    public function destroy(Post $post)
    {
        sleep(1);
        return $post->delete();
    }

    protected function createOrUpdate(Post $post, Request $request): Post
    {
        $request->validate([
            'title' => [
                'required',
                'min:2',
                'max:50',
                Rule::unique($post->getTable())
                    ->when($post->id, fn ($rule) => $rule->ignore($post->id))
            ],
            'slug' => [
                Rule::unique($post->getTable())
                    ->when($post->id, fn ($rule) => $rule->ignore($post->id))
            ],
            'description' => ['nullable'],
            'is_visible' => ['boolean'],
        ]);

        $post->fill([
            'title' => $request->get('title'),
            'slug' => $request->get('slug', str($request->get('title'))->slug()),
            'description' => $request->get('description'),
            'is_visible' => $request->get('is_visible', false),
        ]);
        $post->save();

        return $post;
    }
}
