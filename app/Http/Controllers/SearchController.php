<?php

namespace App\Http\Controllers;

use App\ImageLabel;
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
        $this->validate($request, [
            'search' => 'required',
        ]);

        if (!empty(ImageUpload::where('id', $request->search)->first())) {
            $file = ImageLabel::where('filename', ImageUpload::where('id', $request->search)->first()->filename_post_iva)->first();

            return view('file.file_edit', [
                'file' => $file,
            ]);
        } else {
            return view('error.file_not_found');
        }
    }
}
