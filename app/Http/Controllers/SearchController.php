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
        $this->validate($request, [
            'search' => 'required',
        ]);

        if (!empty(ImageUpload::where('id', $request->search)->first())) {
            $filename = ImageUpload::where('id', $request->search)->first()->filename_post_iva;

            return redirect()
                ->route('file.edit', [
                    "page" => 1,
                    "requestid" => $filename,
                ]);
        } else {
            return view('error.file_not_found');
        }
    }
}
