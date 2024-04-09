<?php

namespace AntoniPutra\Ngeblog\Http\Controllers\Api;

use AntoniPutra\Ngeblog\Models\Post;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    public function index()
    {
        return Post::query()
            ->latest()
            ->paginate(15);
    }
}
