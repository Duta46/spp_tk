<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outbond extends Model
{
    protected $table = 'outbonds';

    protected $fillable = [
        'tahun',
        'nominal'
    ];

    public function PembayaranOutbond()
    {
         return $this->hasMany(PembayaranOutbond::class);
    }
}
