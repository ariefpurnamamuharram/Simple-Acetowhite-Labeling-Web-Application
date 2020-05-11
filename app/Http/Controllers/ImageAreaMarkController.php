<?php

namespace App\Http\Controllers;

class ImageAreaMarkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($requestid)
    {
        return view('label.imageareamark', compact([
            'requestid',
        ]));
    }
}
