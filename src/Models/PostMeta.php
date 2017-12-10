<?php

namespace Antoniputra\Ngeblog\Models;

use Antoniputra\Ngeblog\Models\Blog;
use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    protected $table = 'ngeblog_post_metas';

    protected $fillable = ['blog_id', 'meta_key', 'meta_value'];

    public function blogs()
    {
        return $this->belongsTo(Blog::class);
    }
}
