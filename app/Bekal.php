<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bekal extends Model
{
    protected $table = 'bekals';

    protected $fillable = [
        'id_tahun_bekal',
         'bulan',
         'nominal',
    ];

    public function tahunBekal()
    {
        return $this->belongsTo(TahunBekal::class, 'id_tahun_bekal');
    }
}
