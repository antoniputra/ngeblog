<?php

namespace AntoniPutra\Ngeblog\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PostTag extends Pivot
{
    protected $table = 'ngeblog_post_tag';
}
