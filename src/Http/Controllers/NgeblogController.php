<?php

namespace AntoniPutra\Ngeblog\Http\Controllers;

use Illuminate\Routing\Controller;

class NgeblogController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function blogs()
    {
        return view('ngeblog::blogs');
    }
}
