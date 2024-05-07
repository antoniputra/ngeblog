<?php

namespace AntoniPutra\Ngeblog\Http\Controllers\Api;

use AntoniPutra\Ngeblog\Http\Resources\PostResource;
use AntoniPutra\Ngeblog\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function stats()
    {
        return response()->json([
            'total_all_time' => Post::count(),
            'total_last_month' => Post::query()
                ->whereBetween('created_at', [
                    now()->subMonth()->startOfMonth(),
                    now()->subMonth()->endOfMonth(),
                ])
                ->count(),
        ]);
    }

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
        $post->load('tags');
        return PostResource::make($post)->resolve();
    }

    public function store(Request $request)
    {
        $post = $this->createOrUpdate(new Post, $request);
        return PostResource::make($post)->resolve();
    }
    
    public function update(Post $post, Request $request)
    {
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
            'is_visible' => ['boolean'],
            'excerpt' => ['nullable'],
            'content' => ['required'],
            'tags' => ['array'],
        ]);

        try {
            DB::beginTransaction();
    
            $post->fill([
                'title' => $request->get('title'),
                'slug' => $request->get('slug', str($request->get('title'))->slug()),
                'excerpt' => $request->get('excerpt'),
                'content' => $request->get('content'),
                'is_visible' => $request->get('is_visible', false),
            ]);
            $post->author_id = auth()->user()->id;
            $post->save();
    
            if (! empty($request->get('tags'))) {
                $post->tags()->sync($request->get('tags'));
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        return $post;
    }
}
