<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $table = 'ujians';

    protected $fillable = [
        'jenis_ujian',
        'tahun',
        'semester',
        'nominal'
    ];
}
