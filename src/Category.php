<?php

namespace Antoniputra\Ngeblog;

use Antoniputra\Ngeblog\Blog;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'ngeblog_categories';

    protected $fillable = ['title', 'slug', 'description'];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
