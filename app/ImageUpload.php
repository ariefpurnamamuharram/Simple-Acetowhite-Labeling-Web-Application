<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageUpload extends Model
{
    public const IMAGE_LABEL_POSITIVE_CODE = 1;

    public const IMAGE_LABEL_NEGATIVE_CODE = 0;

    public const IMAGE_NOT_LABELED_CODE = 99;

    protected $fillable = [
        'filename_pre_iva',
        'path_pre_iva',
        'filename_post_iva',
        'path_post_iva',
        'posted_by',
        'label',
        'comment'
    ];
}
