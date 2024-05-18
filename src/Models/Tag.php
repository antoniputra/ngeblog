<?php

namespace AntoniPutra\Ngeblog\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeFilterable(Builder $builder, array $params = []): void
    {
        $search = data_get($params, 'search');
        $builder->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->where('title', 'LIKE', '%'. $search .'%')
                    ->orWhere('slug', 'LIKE', '%'. $search .'%')
                    ->orWhere('excerpt', 'LIKE', '%'. $search .'%');
            });
        });
    }
}
