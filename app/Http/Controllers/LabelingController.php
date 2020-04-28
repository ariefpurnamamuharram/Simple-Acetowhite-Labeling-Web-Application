<?php

namespace App\Http\Controllers;

use App\ImageUpload;
use Illuminate\Http\Request;

class LabelingController extends Controller
{
    public function index() {
        $files = ImageUpload::orderBy('created_at', 'DESC')->paginate(30);
        return view('labelindex', compact([
            'files'
        ]));
    }

    public function edit($requestid) {
        $file = ImageUpload::where('id', $requestid)->first();

        return view('labeledit', compact([
            'file'
        ]));
    }

    public function update(Request $request) {
        ImageUpload::where('id', $request->id)->update([
            'label' => $request->lblIVA
        ]);

        return redirect(route('label.index'));
    }
}
