<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatans';

    protected $fillable = [
        'nominal',
        'keterangan',
    ];

    public function PembayaranKegiatan()
   {
        return $this->hasMany(PembayaranKegiatan::class);
   }
}
