<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageArtifact extends Model
{
    protected $fillable = [
        'filename',
        'email',
        'cbMetaplasiaRing',
        'cbIUD',
        'cbMenstrualBlood',
        'cbSlime',
        'cbFluorAlbus',
        'cbCervicitis',
        'cbPolyp',
        'cbOvulaNabothi',
        'cbEctropion',
        'cbReflections',
    ];
}
