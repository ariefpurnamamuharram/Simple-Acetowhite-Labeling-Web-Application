<?php

namespace App\Http\Controllers;

use App\ImageAreaMark;
use App\ImageLabel;
use App\ImageUpload;
use Illuminate\Support\Facades\File;
use ZipArchive;

class ArchiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.administrator');
    }

    private const LABEL_POSITIVE = 'positive';

    private const LABEL_POSITIVE_CODE = 1;

    private const LABEL_NEGATIVE = 'negative';

    private const LABEL_NEGATIVE_CODE = 0;

    public function downloadPositives()
    {
        // Prepare ZipArchive
        $zip = new ZipArchive;
        $fileName = 'download-positives.zip';

        // Get all positive images
        $images_positive = [];
        foreach (ImageLabel::where('label', ImageUpload::IMAGE_LABEL_POSITIVE_CODE)->get() as $file) {
            array_push($images_positive, $file->filename);
        }

        if (!empty($images_positive)) {
            // Get all negative images
            $images_negative = [];
            foreach (ImageLabel::where('label', ImageUpload::IMAGE_LABEL_NEGATIVE_CODE)->get() as $file) {
                array_push($images_negative, $file->filename);
            }

            // Intersect array
            $files = array_diff($images_positive, $images_negative);

            if ($zip->open(public_path($fileName), ZipArchive::CREATE || ZipArchive::OVERWRITE) === TRUE) {
                // Prepare metadata JSON file
                $data_json = [];

                foreach (array_unique($files) as $key => $value) {
                    $item = public_path('files/images/iva/' . $value);
                    $relativeNameInZipFile = basename($item);
                    $zip->addFile($item, $relativeNameInZipFile);

                    /* // Populate file metadata for JSON.
                    $name = $value->filename_post_iva;
                    $bounding_boxes = [];
                    foreach (ImageAreaMark::where('filename', $value->filename_post_iva)->get() as $key => $value) {
                        array_push($bounding_boxes, [$value->rect_x0, $value->rect_y0, $value->rect_x1, $value->rect_y1]);
                    }
                    array_push($data_json, [
                        'name' => $name,
                        'file' => self::LABEL_IVA_POSITIVE,
                        'bounding_box' => $bounding_boxes,
                    ]); */
                }

                /* // Create file metadata JSON object.
                file_put_contents(public_path('file_metadata.json'), json_encode($data_json));*/

                /* // Add file metadata to zip file.
                $zip->addFile(public_path('file_metadata.json'), basename(public_path('file_metadata.json')));*/

                $zip->close();
            }

            /* // Delete file metadata JSON file.
            File::delete(public_path('file_metadata.json'));*/

            return response()->download(public_path($fileName))->deleteFileAfterSend(true);
        } else {
            return view('error.file_not_found');
        }
    }

    public function downloadNegatives()
    {
        $zip = new ZipArchive;
        $fileName = 'download-negatives.zip';
        $files = ImageUpload::where('file', self::LABEL_NEGATIVE_CODE)->get();

        if (!empty($files)) {
            if ($zip->open(public_path($fileName), ZipArchive::CREATE || ZipArchive::OVERWRITE) === TRUE) {
                $data_json = [];

                foreach ($files as $key => $value) {
                    $item = public_path('files/images/iva/' . $value->filename_post_iva);
                    $relativeNameInZipFile = basename($item);
                    $zip->addFile($item, $relativeNameInZipFile);

                    // Populate file metadata for JSON.
                    $name = $value->filename_post_iva;
                    $bounding_boxes = [];
                    foreach (ImageAreaMark::where('filename', $value->filename_post_iva)->get() as $key => $value) {
                        array_push($bounding_boxes, [$value->rect_x0, $value->rect_y0, $value->rect_x1, $value->rect_y1]);
                    }
                    array_push($data_json, [
                        'name' => $name,
                        'file' => self::LABEL_IVA_NEGATIVE,
                        'bounding_box' => $bounding_boxes,
                    ]);
                }

                // Create file metadata JSON object.
                file_put_contents(public_path('file_metadata.json'), json_encode($data_json));

                // Add file metadata to zip file.
                $zip->addFile(public_path('file_metadata.json'), basename(public_path('file_metadata.json')));

                $zip->close();
            }

            // Delete file metadata JSON file.
            File::delete(public_path('file_metadata.json'));

            return response()->download(public_path($fileName))->deleteFileAfterSend(true);
        } else {
            return view('error.filenotfound');
        }
    }
}
