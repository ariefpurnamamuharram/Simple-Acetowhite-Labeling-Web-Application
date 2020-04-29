<?php

namespace App\Http\Controllers;

use App\ImageUpload;
use Illuminate\Http\RedirectResponse;
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
        $comment = null;
        if(!empty($request->comment)) {
            $comment = $request->comment;
        } else {
            $comment = '-';
        }

        if(!empty($request->preIVAImage)) {
            $image = $request->file('preIVAImage');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('files'), $imageName);

            ImageUpload::where('id', $request->id)->update([
                'filename_pre_iva' => $imageName,
                'path_pre_iva' => $imageName,
                'label' => $request->lblIVA,
                'comment' => $comment
            ]);
        } else {
            ImageUpload::where('id', $request->id)->update([
                'label' => $request->lblIVA,
                'comment' => $comment
            ]);
        }

        return redirect(route('label.index'));
    }

    public function delete($request): RedirectResponse {
        ImageUpload::where('id', $request)->delete();

        return redirect()
            ->back()
            ->withSuccess(sprintf("Data berhasil dihapus"));
    }
}
