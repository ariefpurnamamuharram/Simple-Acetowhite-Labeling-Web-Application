<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImageUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fileUpload() {
        return view('imageupload');
    }

    public function fileStore(Request $request) {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();

        // Use this to store image via File.
        // $path = $image->store('files');

        // Image will be put in files public folder.
        $ext = pathinfo($imageName, PATHINFO_EXTENSION);
        $filename = Str::random(24);
        $filenameWithExt = $filename.".".$ext;

        $image->move(public_path('files/images/iva'), $filenameWithExt);

        // Save to database.
        ImageUpload::create([
            'filename_pre_iva' => '',
            'path_pre_iva' => '',
            'filename_post_iva' => $filenameWithExt,
            'path_post_iva' => $filenameWithExt,
            'posted_by' => Auth::User()->name,
            'edited_by' => '',
            'label' => 99,
            'comment' => ''
        ]);

        return response()->json(['success'=>$imageName]);
    }
}
