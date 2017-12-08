<?php

namespace Antoniputra\Ngeblog\Http\Controllers;

use Antoniputra\Ngeblog\Facade as NgeblogFacade;
use Antoniputra\Ngeblog\Http\Controllers\BaseController;
use Antoniputra\Ngeblog\Http\Middleware\Authenticate;
use Antoniputra\Ngeblog\Repositories\CategoryRepository;
use Antoniputra\Ngeblog\Repositories\PostMetaRepository;
use Illuminate\Http\Request;

class PostMetaController extends BaseController
{
    public function __construct(PostMetaRepository $repo, CategoryRepository $category)
    {
        $this->middleware(Authenticate::class);
        $this->repo     = $repo;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title'          => 'Post Meta Configuration',
            'configurations' => $this->repo->getConfiguration(),
        ];

        return view('ngeblog::admin.postmeta.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title'        => 'Add Post Meta Configuration',
            'type_field'   => $this->repo->getPostMetaFieldType(),
            'cat_dropdown' => NgeblogFacade::getDropdownCategory(),
        ];
        return view('ngeblog::admin.postmeta.create', $data);
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
            'meta_key'   => 'required',
            'meta_field' => 'required',
        ]);

        // get category
        $category = $this->category->getDetail($request->get('category_id'), false);

        // add category name to request
        $request->request->add(['category_title' => $category->title ?? '']);

        $this->repo->saveConfiguration($request->except('_token'));

        return redirect()->route('ngeblog.postmeta.index')->withMessage([
            'type'    => 'is-success',
            'content' => 'Post Meta Configuration has been added!',
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
        $category = $this->repo->getDetail($id);
        if (!$category) {
            abort(404);
        }

        $data = [
            'title'    => 'Edit Category: ' . $category['title'],
            'category' => $category,
        ];
        return view('ngeblog::admin.category.edit', $data);
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

        return redirect()->route('ngeblog.category.index')->withMessage([
            'type'    => 'is-success',
            'content' => 'Category has been updated!',
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
        return redirect()->route('ngeblog.category.index')->withMessage([
            'type'    => 'is-success',
            'content' => 'Category has been deleted',
        ]);
    }
}
