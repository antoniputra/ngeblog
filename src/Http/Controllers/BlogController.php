<?php

namespace Antoniputra\Ngeblog\Http\Controllers;

use Antoniputra\Ngeblog\Facade as NgeblogFacade;
use Antoniputra\Ngeblog\Http\Controllers\BaseController;
use Antoniputra\Ngeblog\Http\Middleware\Authenticate;
use Antoniputra\Ngeblog\Repositories\BlogRepository;
use Antoniputra\Ngeblog\Repositories\PostMetaRepository;
use Illuminate\Http\Request;

class BlogController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BlogRepository $repo, PostMetaRepository $postMeta)
    {
        $this->middleware(Authenticate::class);
        $this->repo     = $repo;
        $this->postMeta = $postMeta;
    }

    /**
     * Display dashboard page
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard',
        ];
        return view('ngeblog::admin.dashboard', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Blog Index',
            'blogs' => $this->repo->getPaginateLatest(10),
        ];

        return view('ngeblog::admin.blog.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title'        => 'Create Blog',
            'cat_dropdown' => NgeblogFacade::getDropdownCategory(),
        ];

        return view('ngeblog::admin.blog.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $this->repo->baseCreate($request->all());

        return redirect()->route('ngeblog.blog.index')->withMessage([
            'type'    => 'is-success',
            'content' => 'Blog has been created!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = $this->repo->getDetail($id);
        if (!$blog) {
            abort(404);
        }
        $data = [
            'title'        => 'Edit Blog: ' . $blog['title'],
            'cat_dropdown' => NgeblogFacade::getDropdownCategory(),
            'post_meta'    => $this->postMeta->findByCategoryId($blog->category_id),
            'blog'         => $blog,
        ];
        return view('ngeblog::admin.blog.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $this->repo->baseUpdate($id, $request->all());

        return redirect()->route('ngeblog.blog.index')->withMessage([
            'type'    => 'is-success',
            'content' => 'Blog has been updated!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repo->baseDelete($id);
        return redirect()->route('ngeblog.blog.index')->withMessage([
            'type'    => 'is-success',
            'content' => 'Blog has been deleted!',
        ]);
    }
}
