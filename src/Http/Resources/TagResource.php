<?php

namespace AntoniPutra\Ngeblog\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
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
            'description' => $this->whenHas('description'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            
            'posts' => $this->whenLoaded('posts'),
        ];
    }
}
