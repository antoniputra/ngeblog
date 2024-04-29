<?php

namespace AntoniPutra\Ngeblog\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'author_id' => $this->author_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'is_visible' => $this->is_visible,
            'cover_image_path' => $this->cover_image_path,
            'first_published_at' => $this->first_published_at,
            'schedule_publish_at' => $this->schedule_publish_at,
            'editor_type' => $this->whenHas('editor_type'),
            'excerpt' => $this->whenHas('excerpt'),
            'content' => $this->whenHas('content'),
            'parsed_content' => $this->when(
                $this->editor_type && $this->content,
                fn () => $this->parsed_content
            ),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,

            'author' => $this->whenLoaded('author'),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
    }
}
