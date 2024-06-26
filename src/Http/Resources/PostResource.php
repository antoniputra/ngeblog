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
            'content_type' => $this->whenHas('content_type'),
            'excerpt' => $this->whenHas('excerpt'),
            'content' => $this->whenHas('content'),

            // * upcoming later
            // 'parsed_content' => $this->when(
            //     $this->content_type && $this->content,
            //     fn () => $this->parsed_content
            // ),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,

            'metas_count' => $this->whenCounted('metas'),
            
            'author' => $this->whenLoaded('author'),
            'metas' => $this->whenLoaded('metas'),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
    }
}
