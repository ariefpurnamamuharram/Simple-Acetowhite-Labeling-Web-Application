<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageUpload extends Model
{
    protected $fillable = [
        'filename_pre_iva',
        'path_pre_iva',
        'filename_post_iva',
        'path_post_iva',
        'label',
        'comment'
    ];
}
