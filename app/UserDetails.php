<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $table = 'users_details';

    protected $fillable = [
        'email',
        'is_administrator',
    ];
}
