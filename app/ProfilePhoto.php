<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilePhoto extends Model
{
    protected $table = 'profile_photos';

    protected $fillable = [
        'profile_photo',
    ];
}
