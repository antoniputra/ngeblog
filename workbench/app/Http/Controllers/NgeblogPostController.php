<?php

namespace Workbench\App\Http\Controllers;

use AntoniPutra\Ngeblog\Facades\Ngeblog;
use AntoniPutra\Ngeblog\Models\Post;
use Illuminate\Routing\Controller;

class NgeblogPostController extends Controller
{
    public function index()
    {
        return view('ngeblog.index', [
            'title' => 'Ngeblog',
            'posts' => Ngeblog::getPublishedPostsAsPaginated()
        ]);
    }

    public function show(Post $post)
    {
        $post->load('tags');

        return view('ngeblog.show', [
            'title' => $post->title,
            'post' => $post,
        ]);
    }
}
