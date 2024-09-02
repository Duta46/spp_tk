<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bekal extends Model
{
    protected $table = 'bekals';

    protected $fillable = [
         'tahun',
         'bulan',
         'nominal',
    ];

    
}
