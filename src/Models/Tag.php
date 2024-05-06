<?php

namespace AntoniPutra\Ngeblog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'ngeblog_tags';

    protected $guarded = [];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'ngeblog_post_tag')
            ->using(PostTag::class)
            ->withTimestamps();
    }

    public function toggleVisibility()
    {
        if (! $this->exists) {
            return;
        }

        $this->is_visible = ! $this->is_visible;
        return $this->save();
    }
}
