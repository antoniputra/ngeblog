<?php

namespace AntoniPutra\Ngeblog\Http\Controllers\Api;

use AntoniPutra\Ngeblog\Http\Resources\TagResource;
use AntoniPutra\Ngeblog\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    public function dropdown()
    {
        return TagResource::collection(Tag::query()->latest()->get());
    }

    public function index()
    {
        $result = Tag::query()
            ->select([
                'id',
                'title',
                'slug',
                'is_visible',
                'description',
                'created_at',
                'updated_at',
            ])
            ->withCount('posts')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return TagResource::collection($result);
    }

    public function show(Tag $tag)
    {
        return TagResource::make($tag)->resolve();
    }

    public function store(Request $request)
    {
        $tag = $this->createOrUpdate(new Tag, $request);
        return TagResource::make($tag)->resolve();
    }
    
    public function update(Tag $tag, Request $request)
    {
        $tag = $this->createOrUpdate($tag, $request);
        return TagResource::make($tag)->resolve();
    }

    public function toggleVisibility(Tag $tag)
    {
        $tag->toggleVisibility();
        return TagResource::make($tag)->resolve();
    }

    public function destroy(Tag $tag)
    {
        return $tag->delete();
    }

    protected function createOrUpdate(Tag $tag, Request $request): Tag
    {
        $request->validate([
            'title' => [
                'required',
                'min:2',
                'max:50',
                Rule::unique($tag->getTable())
                    ->when($tag->id, fn ($rule) => $rule->ignore($tag->id))
            ],
            'slug' => [
                Rule::unique($tag->getTable())
                    ->when($tag->id, fn ($rule) => $rule->ignore($tag->id))
            ],
            'description' => ['nullable'],
            'is_visible' => ['boolean'],
        ]);

        $tag->fill([
            'title' => $request->get('title'),
            'slug' => $request->get('slug', str($request->get('title'))->slug()),
            'description' => $request->get('description'),
            'is_visible' => $request->get('is_visible', false),
        ]);
        $tag->save();

        return $tag;
    }
}
