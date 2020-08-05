<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageAreaMark extends Model
{
    protected $table = 'image_area_marks';

    protected $fillable = [
        'filename',
        'email',
        'rect_x0',
        'rect_y0',
        'rect_x1',
        'rect_y1',
        'label',
        'description'
    ];
}
