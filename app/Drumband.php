<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drumband extends Model
{
    protected $table = 'drumbands';

    protected $fillable = [
        'tahun',
        'nominal'
    ];

    public function PembayaranDrumband()
    {
         return $this->hasMany(PembayaranDrumband::class);
    }
}
