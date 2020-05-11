<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageUpload;
use App\ImageArtifact;
use App\ImageMark;
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
        return view('upload.imageupload');
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

        // Move image to public folder.
        $image->move(public_path('files/images/iva'), $filenameWithExt);

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

        ImageArtifact::create([
            'filename' => $filenameWithExt,
            'cbMetaplasiaRing' => false,
            'cbIUD' => false,
            'cbMenstrualBlood' => false,
            'cbSlime'=> false,
            'cbFluorAlbus' => false,
            'cbCervicitis' => false,
            'cbCarcinoma' => false,
            'cbPolyp' => false,
            'cbOvulaNabothi' => false,
            'cbEctropion' => false
        ]);

        ImageMark::create([
            'filename' => $filenameWithExt,
            'is_marked' => false
        ]);

        return response()->json(['success'=>$imageName]);
    }
}
