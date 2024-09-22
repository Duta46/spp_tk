<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembayaranBekal extends Model
{
    use SoftDeletes;
    protected $table = 'pembayaran_bekals';

    protected $fillable = [
        'id_petugas',
        'id_siswa',
        'id_bekal',
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

    public function bekal()
    {
        return $this->belongsTo(Bekal::class,'id_bekal','id');
    }


}
