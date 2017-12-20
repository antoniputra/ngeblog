<?php

namespace Antoniputra\Ngeblog\Http\Controllers;

use Antoniputra\Ngeblog\Facade as NgeblogFacade;
use Antoniputra\Ngeblog\Http\Controllers\BaseController;
use Antoniputra\Ngeblog\Http\Middleware\Authenticate;
use Antoniputra\Ngeblog\Repositories\MetaRepository;
use Illuminate\Http\Request;

class MetaController extends BaseController
{
    public function __construct(MetaRepository $repo)
    {
        $this->middleware(Authenticate::class);
        $this->repo = $repo;
    }

    public function index()
    {
        $data = [
            'title' => 'Meta Configuration',
            'metas' => $this->repo->getPaginateLatest(),
        ];

        return view('ngeblog::admin.meta.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create a Meta Configuration for Blog',
            'fields_dropdown' => $this->repo->getFieldsType(),
            'category_dropdown' => NgeblogFacade::getDropdownCategory('id', 'title', '<< Apply to All Category >>'),
        ];

        return view('ngeblog::admin.meta.create', $data);
    }

    public function store(Request $request)
    {
        $this->_runValidate($request);

        $this->repo->baseCreate($request->all());
        return redirect()->route('ngeblog.meta.index')->withMessage([
            'type' => 'is-success',
            'content' => 'Meta has been created!',
        ]);
    }

    public function edit($id)
    {
        $meta = $this->repo->baseIdentifier($id);
        if (!$meta) {
            abort(404);
        }

        $data = [
            'title' => 'Edit a Meta Configuration',
            'meta' => $meta,
            'fields_dropdown' => $this->repo->getFieldsType(),
            'category_dropdown' => NgeblogFacade::getDropdownCategory('id', 'title', '<< Apply to All Category >>'),
        ];

        return view('ngeblog::admin.meta.edit', $data);
    }

    public function update($id, Request $request)
    {
        $this->_runValidate($request, $id);

        $meta = $this->repo->baseUpdate($id, $request->all());
        return redirect()->route('ngeblog.meta.index')->withMessage([
            'type' => 'is-success',
            'content' => 'Meta has been updated!',
        ]);
    }

    public function destroy($id)
    {
        $this->repo->baseDelete($id);
        return redirect()->route('ngeblog.meta.index')->withMessage([
            'type' => 'is-success',
            'content' => 'Meta has been deleted',
        ]);
    }

    public function getJson(Request $request)
    {
        // if (!$request->ajax()) {
        //     abort(404);
        // }

        // sleep(1);
        return $this->repo->getAllFilterable();
    }

    protected function _runValidate(Request $request, $forgetId = null)
    {
        $forgetId = $forgetId ?: 'NULL';
        $rules = [
            'meta_field' => 'required',
        ];

        $this->validate($request, $rules, [], [
            'meta_field' => 'Meta Field Type',
        ]);
    }
}
