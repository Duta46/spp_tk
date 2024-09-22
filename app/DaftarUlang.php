<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarUlang extends Model
{
    protected $table = 'daftar_ulangs';

protected $fillable = [
        'tahun',
        'nominal',
    ];
}
