<?php

namespace Antoniputra\Ngeblog\Models;

use Antoniputra\Ngeblog\Models\BlogMeta;
use Antoniputra\Ngeblog\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $table = 'ngeblog_metas';

    protected $fillable = ['category_id', 'meta_field', 'meta_default_key', 'meta_default_value'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function blogmetas()
    {
        return $this->hasMany(BlogMeta::class);
    }
}
