<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembayaranKegiatan extends Model
{
    use SoftDeletes;
    protected $table = 'pembayaran_kegiatans';

    protected $fillable = [
        'id_petugas',
        'id_siswa',
        'id_kegiatan',
        'jumlah_bayar'
    ];

    public function users()
    {
         return $this->belongsTo(User::class,'id_petugas', 'id');
    }

    public function siswa()
    {
         return $this->belongsTo(Siswa::class,'id_siswa','id','nisn');
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class,'id_kegiatan','id');
    }

}
