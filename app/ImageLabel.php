<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageLabel extends Model
{
    protected $table = 'image_labels';

    protected $fillable = [
        'filename',
        'email',
        'label',
        'comment'
    ];
}
