<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class indexController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function index() : View
    {
        return view('index.index');
    }

    //
}
