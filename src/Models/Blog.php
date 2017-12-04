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

    public function scopeFilterable($query)
    {
        $q = $query;
        $q = $q->select(['ngeblog_blogs.*', 'ngeblog_categories.title as category_title'])->join('ngeblog_categories', 'ngeblog_blogs.category_id', '=', 'ngeblog_categories.id');

        if ($keyword = request('keyword')) {
            $q = $q->where(function ($w) use ($keyword) {
                $w->where('ngeblog_blogs.title', 'LIKE', "%$keyword%")
                    ->orWhere('ngeblog_categories.title', 'LIKE', "%$keyword%");
            });
        }

        return $q;
    }
}
