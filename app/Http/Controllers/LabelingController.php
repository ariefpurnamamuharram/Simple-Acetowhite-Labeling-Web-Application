<?php

namespace App\Http\Controllers;

use App\ImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class LabelingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $files = ImageUpload::orderBy('created_at', 'DESC')->paginate(8);
        return view('labelindex', compact([
            'files'
        ]));
    }

    public function search(Request $request) {
        $file = ImageUpload::where('id', $request->search)->first();

        if(!empty($file)) {
            return view('labeledit', compact([
                'file'
            ]));
        }
        else {
            return view('filenotfound');
        }
    }

    public function edit($requestid) {
        $file = ImageUpload::where('id', $requestid)->first();

        return view('labeledit', compact([
            'file'
        ]));
    }

    public function update(Request $request) {
        $lblIVA = null;
        $editor = null;
        if(isset($request->lblIVA)) {
            $lblIVA = $request->lblIVA;
            $editor = Auth::User()->name;
        } else {
            $lblIVA = 99;
            $editor = '';
        }

        $comment = null;
        if(!empty($request->comment)) {
            $comment = $request->comment;
        } else {
            $comment = '-';
        }

        if(!empty($request->preIVAImage)) {
            $image = $request->file('preIVAImage');
            $imageName = $image->getClientOriginalName();

            // Image will be put in files public folder.
            $ext = pathinfo($imageName, PATHINFO_EXTENSION);
            $filename = Str::random(24);
            $filenameWithExt = $filename.".".$ext;

            $image->move(public_path('files/images/iva'), $filenameWithExt);

            ImageUpload::where('id', $request->id)->update([
                'filename_pre_iva' => $filenameWithExt,
                'path_pre_iva' => $filenameWithExt,
                'edited_by' => $editor,
                'label' => $lblIVA,
                'comment' => $comment
            ]);
        } else {
            ImageUpload::where('id', $request->id)->update([
                'label' => $lblIVA,
                'edited_by' => $editor,
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
