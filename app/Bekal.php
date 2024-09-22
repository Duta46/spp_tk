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

    public function pembayaranBekal() {
        return $this->hasMany(PembayaranBekal::class);
    }

    // public function tahunBekal()
    // {
    //     return $this->belongsTo(TahunBekal::class, 'id_tahun_bekal');
    // }
}
