<?php

namespace Antoniputra\Ngeblog\Models;

use Antoniputra\Ngeblog\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $table = 'ngeblog_blogs';

    protected $fillable = ['category_id', 'title', 'slug', 'content', 'status', 'editor_type'];

    public function user()
    {
        return $this->belongsTo(config('ngeblog.user'));
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
