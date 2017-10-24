<?php

namespace Antoniputra\Ngeblog;

use Antoniputra\Ngeblog\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $table = 'ngeblog_blogs';

    protected $fillable = ['category_id', 'title', 'slug', 'content'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
