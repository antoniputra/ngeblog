<?php

namespace AntoniPutra\Ngeblog\Http\Controllers;

use Illuminate\Routing\Controller;

class NgeblogController extends Controller
{
    public function __invoke()
    {
        return view('ngeblog::ngeblog', [
            'title' => 'Ngeblog',
            'ngeblogBasePath' => config('ngeblog.path'),
        ]);
    }
}
