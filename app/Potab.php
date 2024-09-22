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

    public function pembayaranPotab() {
        return $this->hasMany(PembayaranPotab::class);
    }

    // public function tahunPotab()
    // {
    //     return $this->belongsTo(TahunPotab::class, 'id_tahun_potab');
    // }
}
