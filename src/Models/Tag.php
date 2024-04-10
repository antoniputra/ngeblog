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

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'ngeblog_post_tag')->using(PostTag::class);
    }
}
