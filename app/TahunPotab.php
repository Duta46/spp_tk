<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunPotab extends Model
{
    protected $table = 'tahun_potabs';

    protected $fillable = [
         'tahun'
    ];

    public function potab()
    {
        return $this->hasMany(Potab::class);
    }
}
