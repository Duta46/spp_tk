<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembayaranPotab extends Model
{
    use SoftDeletes;
    protected $table = 'pembayaran_potabs';

    protected $fillable = [
        'id_petugas',
        'id_siswa',
        'id_potab',
        'jumlah_bayar',
    ];

    public function users()
    {
         return $this->belongsTo(User::class,'id_petugas', 'id');
    }

    public function siswa()
    {
         return $this->belongsTo(Siswa::class,'id_siswa','id','nisn');
    }

    public function potab()
    {
        return $this->belongsTo(Potab::class,'id_potab','id');
    }
}
