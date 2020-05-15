<?php

namespace App\Http\Controllers;

use App\ImageUpload;
use Illuminate\Http\Request;
use File;
use ZipArchive;

class ArchiveController extends Controller
{
    public function downloadZipPositiveIVA() {
        $zip = new ZipArchive;

        $fileName = 'download-iva-positive.zip';

        $files = ImageUpload::where('label', 1)->get();

        if(!$files->isEmpty()) {
            if ($zip->open(public_path($fileName), ZipArchive::CREATE || ZipArchive::OVERWRITE) === TRUE)
            {
                foreach ($files as $key => $value) {
                    $item = public_path('files/images/iva/'.$value->filename_post_iva);
                    $relativeNameInZipFile = basename($item);
                    $zip->addFile($item, $relativeNameInZipFile);
                }

                $zip->close();
            }

            return response()->download(public_path($fileName))->deleteFileAfterSend(true);
        }
        else {
            return view('error.filenotfound');
        }
    }

    public function downloadZipNegativeIVA() {
        $zip = new ZipArchive;

        $fileName = 'download-iva-negative.zip';

        $files = ImageUpload::where('label', 0)->get();

        if(!$files->isEmpty()) {
            if ($zip->open(public_path($fileName), ZipArchive::CREATE || ZipArchive::OVERWRITE) === TRUE)
            {
                foreach ($files as $key => $value) {
                    $item = public_path('files/images/iva/'.$value->filename_post_iva);
                    $relativeNameInZipFile = basename($item);
                    $zip->addFile($item, $relativeNameInZipFile);
                }

                $zip->close();
            }

            return response()->download(public_path($fileName))->deleteFileAfterSend(true);
        } else {
            return view('error.filenotfound');
        }
    }
}
