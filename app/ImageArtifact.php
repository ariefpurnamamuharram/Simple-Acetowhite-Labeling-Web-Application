<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageArtifact extends Model
{
    protected $fillable = [
        'filename',
        'cbMetaplasiaRing',
        'cbIUD',
        'cbMenstrualBlood',
        'cbSlime',
        'cbFluorAlbus',
        'cbCervicitis',
        'cbPolyp',
        'cbOvulaNabothi',
        'cbEctropion'
    ];
}
