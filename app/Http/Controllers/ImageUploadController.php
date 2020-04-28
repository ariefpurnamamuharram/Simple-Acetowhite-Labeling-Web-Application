<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageUpload;
use Illuminate\Support\Facades\DB;

class ImageUploadController extends Controller
{
    public function fileUpload() {
        return view('imageupload');
    }

    public function fileStore(Request $request) {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();

        // Use this to store image via File.
        // $path = $image->store('files');

        // Image will be put in files public folder.
        $image->move(public_path('files'), $imageName);

        // Save to database.
        ImageUpload::create([
            'filename' => $imageName,
            'path' => $imageName,
            'label' => '99'
        ]);

        return response()->json(['success'=>$imageName]);
    }
}
