<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Potab extends Model
{
    protected $table = 'potabs';

    protected $fillable = [
         'tahun',
         'bulan',
         'nominal',
    ];

}
