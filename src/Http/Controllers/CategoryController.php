<?php

namespace Antoniputra\Ngeblog\Http\Controllers;

use Antoniputra\Ngeblog\Facade as NgeblogFacade;
use Antoniputra\Ngeblog\Http\Controllers\BaseController;
use Antoniputra\Ngeblog\Http\Middleware\Authenticate;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title'      => 'Category Index',
            'categories' => NgeblogFacade::getLatestCategory(),
        ];

        return view('ngeblog::admin.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Create Category',
        ];
        return view('ngeblog::admin.category.create', $data);
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

        NgeblogFacade::createCategory($request->all());

        return redirect()->route('ngeblog.category.index')->withMessage([
            'type'    => 'is-success',
            'content' => 'Category has been created!',
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
        $category = NgeblogFacade::findCategory($id);
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

        NgeblogFacade::updateCategory($id, $request->all());

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
        NgeblogFacade::deleteCategory($id);
        return redirect()->route('ngeblog.category.index')->withMessage([
            'type'    => 'is-success',
            'content' => 'Category has been deleted',
        ]);
    }
}
