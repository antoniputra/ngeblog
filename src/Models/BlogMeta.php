<?php

namespace Antoniputra\Ngeblog\Models;

use Antoniputra\Ngeblog\Models\Blog;
use Antoniputra\Ngeblog\Models\Meta;
use Illuminate\Database\Eloquent\Model;

class BlogMeta extends Model
{
    protected $table = 'ngeblog_blog_metas';

    public $timestamps = false;

    protected $fillable = ['blog_id', 'meta_id', 'order', 'meta_field', 'meta_key', 'meta_value'];

    public function blogs()
    {
        return $this->belongsTo(Blog::class);
    }

    public function meta()
    {
        return $this->belongsTo(Meta::class);
    }
}
