<?php

namespace AntoniPutra\Ngeblog\Http\Controllers;

use AntoniPutra\Ngeblog\ngeblog;
use Illuminate\Routing\Controller;

class NgeblogController extends Controller
{
    public function __invoke()
    {
        return view('ngeblog::ngeblog', [
            'title' => 'Ngeblog',
            'ngeblogFrontendConfig' => ngeblog::frontendConfig(),
        ]);
    }
}
