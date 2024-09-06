<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Potab extends Model
{
    protected $table = 'potabs';

    protected $fillable = [
        'id_tahun_potab',
         'bulan',
         'nominal',
    ];

    public function tahunPotab()
    {
        return $this->belongsTo(TahunPotab::class, 'id_tahun_potab');
    }
}
