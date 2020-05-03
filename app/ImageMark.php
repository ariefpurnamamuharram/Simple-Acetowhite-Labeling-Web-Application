<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageMark extends Model
{
    protected $fillable = [
        'filename',
        'is_marked'
    ];
}
