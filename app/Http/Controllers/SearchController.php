<?php

namespace App\Http\Controllers;

use App\ImageUpload;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        $file = ImageUpload::where('id', $request->search)->first();

        if (!empty($file)) {
            return view('dashboard.dashboard', [
                'file' => $file,
            ]);
        } else {
            return view('error.file_not_found');
        }
    }
}
