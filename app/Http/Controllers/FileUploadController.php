<?php

namespace App\Http\Controllers;

use App\ImageArtifact;
use App\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fileUpload()
    {
        return view('upload.image_upload');
    }

    public function fileStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();

        // Use this to store image via File.
        // $path = $image->store('files');

        // Image will be put in files public folder.
        $ext = pathinfo($imageName, PATHINFO_EXTENSION);
        $filename = Str::random(24);
        $filenameWithExt = $filename . "." . $ext;

        // Move image to public folder.
        $image->move(public_path('files/images/iva'), $filenameWithExt);

        ImageUpload::create([
            'filename_post_iva' => $filenameWithExt,
            'path_post_iva' => $filenameWithExt,
            'uploaded_by' => Auth::User()->email,
        ]);

        return response()->json(['success' => $imageName]);
    }
}
