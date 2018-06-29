<?php

namespace App\Http\Controllers;
use App\Http\Controllers\CrudHelper\ControllerCrud;
use App\Http\Controllers\CrudHelper\ControllerUtils;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class HomeController extends ControllerCrud
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inicio');
    }


}
