<?php

namespace Antoniputra\Ngeblog\Http\Controllers;

use Antoniputra\Ngeblog\Facade as NgeblogFacade;
use Antoniputra\Ngeblog\Http\Controllers\BaseController;

class NgeblogController extends BaseController
{
    public function categoryIndex()
    {
        // ...
    }

    public function categoryShow($category)
    {
        $category = NgeblogFacade::findCategory($category);
        if (!$category) {
            abort(404);
        }

        return view('ngeblog_public::category_show', [
            'title'    => $category['title'],
            'category' => $category,
        ]);
    }

    public function blogIndex()
    {
        return view('ngeblog_public::blog_index', [
            'title' => 'Homepage',
        ]);
    }

    public function blogShow($blog)
    {
        $blog = NgeblogFacade::findBlog($blog);
        if (!$blog) {
            abort(404);
        }

        return view('ngeblog_public::blog_show', [
            'title' => $blog['title'],
            'blog'  => $blog,
        ]);
    }
}
