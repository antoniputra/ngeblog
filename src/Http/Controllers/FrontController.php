<?php

namespace Antoniputra\Ngeblog\Http\Controllers;

use Antoniputra\Ngeblog\Facade as NgeblogFacade;
use Antoniputra\Ngeblog\Http\Controllers\BaseController;

class FrontController extends BaseController
{
    public function categoryShow($id)
    {
        $category = NgeblogFacade::category()->getDetail($id);
        if (!$category) {
            abort(404);
        }

        return view('ngeblog_themes::category_show', [
            'title' => $category['title'],
            'category' => $category,
        ]);
    }

    public function blogIndex()
    {
        $blogs = NgeblogFacade::blog()->getPaginateLatest(7, true);

        return view('ngeblog_themes::cleanblog.index', [
            'title' => 'Homepage',
            'blogs' => $blogs,
        ]);
    }

    public function blogShow($slug)
    {
        $blog = NgeblogFacade::blog()->getDetailBySlug($slug);
        if (!$blog) {
            abort(404);
        }

        return view('ngeblog_themes::cleanblog.single', [
            'title' => $blog['title'],
            'blog' => $blog,
        ]);
    }
}
