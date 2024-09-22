<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ijazah extends Model
{
    protected $table = 'ijazahs';

    protected $fillable = [
        'tahun',
        'nominal'
    ];

    public function PembayaranIjazah()
    {
         return $this->hasMany(PembayaranIjazah::class);
    }
}
