<?php

namespace AntoniPutra\Ngeblog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Postmeta extends Model
{
    use HasFactory;

    const FIELD_TYPE_TEXT = 'text';
    const FIELD_TYPE_TEXTAREA = 'textarea';

    protected $table = 'ngeblog_postmetas';

    protected $guarded = [];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    // * Dynamically casting the attributes.
    // protected function getCastType($key)
    // {
    //     if ($key == 'value' && !empty($this->type)) {
    //       return $this->type;
    //     } else {
    //       return parent::getCastType($key);
    //     }
    // }
}
