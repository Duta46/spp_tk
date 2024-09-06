<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunBekal extends Model
{
    protected $table = 'tahun_bekals';

    protected $fillable = [
         'tahun'
    ];

    public function bekal()
    {
        return $this->hasMany(Bekal::class);
    }
}
