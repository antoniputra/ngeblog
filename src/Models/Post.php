<?php

namespace AntoniPutra\Ngeblog\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    const EDITOR_TYPE_MARKDOWN = 'markdown';
    
    const EDITOR_TYPE_RICHTEXT = 'richtext';

    protected $table = 'ngeblog_posts';

    protected $guarded = [];

    public function author(): BelongsTo
    {
        return $this->belongsTo('App\\Models\\User', 'author_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'ngeblog_post_tag')->using(PostTag::class);
    }

    protected function parsedContent(): Attribute
    {
        return Attribute::get(function () {
            if (! $this->exists) {
                return null;
            }

            return match ($this->editor_type) {
                null => null,
                self::EDITOR_TYPE_MARKDOWN => $this->parseMarkdown(),
                self::EDITOR_TYPE_RICHTEXT => $this->parseRichtext(),
            };
        });
    }

    protected function parseMarkdown()
    {
        return 'INI YA'. Str::markdown($this->content);
    }
    
    protected function parseRichtext()
    {
        return $this->content;
    }
}
