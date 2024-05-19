<?php

namespace AntoniPutra\Ngeblog\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    const CONTENT_TYPE_MARKDOWN = 'markdown';
    
    const CONTENT_TYPE_RICHTEXT = 'richtext';

    protected $table = 'ngeblog_posts';

    protected $guarded = [];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo('App\\Models\\User', 'author_id');
    }

    public function metas(): HasMany
    {
        return $this->hasMany(Postmeta::class, 'post_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'ngeblog_post_tag')
            ->using(PostTag::class)
            ->withTimestamps();
    }

    public function scopeSortable(Builder $builder, array $sort = [], callable $defaultSort = null): void
    {
        $sortColumn = data_get($sort, 'sort.column');
        $sortDirection = data_get($sort, 'sort.direction');
        
        if ($sortColumn && $sortDirection) {
            $builder->orderBy($sortColumn, $sortDirection);
        } else if (!empty($defaultSort)) {
            $defaultSort($builder);
        }
    }

    public function scopeFilterable(Builder $builder, array $params = []): void
    {
        $search = data_get($params, 'search');
        $author = data_get($params, 'author');
        $tags = data_get($params, 'tags', []);

        $builder->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->where('title', 'LIKE', '%'. $search .'%')
                    ->orWhere('slug', 'LIKE', '%'. $search .'%')
                    ->orWhere('excerpt', 'LIKE', '%'. $search .'%');
            });
        });
        
        $builder->when($author, function ($q) use ($author) {
            $q->where('author_id', $author);
        });
        
        $builder->when(!empty($tags), function ($q) use ($tags) {
            $q->whereHas('tags', function ($sub) use ($tags) {
                $sub->whereIn('tags.id', $tags);
            });
        });
    }

    public function scopePublished(Builder $builder): void
    {
        $builder->where('is_visible', true);
    }

    public function toggleVisibility()
    {
        if (! $this->exists) {
            return;
        }

        $this->is_visible = ! $this->is_visible;
        return $this->save();
    }

    // protected function parsedContent(): Attribute
    // {
    //     return Attribute::get(function () {
    //         if (! $this->exists) {
    //             return null;
    //         }

    //         return match ($this->content_type) {
    //             null => null,
    //             self::CONTENT_TYPE_MARKDOWN => $this->parseMarkdown(),
    //             self::CONTENT_TYPE_RICHTEXT => $this->parseRichtext(),
    //         };
    //     });
    // }

    // protected function parseMarkdown()
    // {
    //     return Str::markdown($this->content);
    // }
    
    // protected function parseRichtext()
    // {
    //     return $this->content;
    // }
}
