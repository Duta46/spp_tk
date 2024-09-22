<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembayaranDrumband extends Model
{

    use SoftDeletes;
    protected $table = 'pembayaran_drumbands';

    protected $fillable = [
        'id_petugas',
        'id_siswa',
        'id_drumband',
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

    public function drumband()
    {
        return $this->belongsTo(Drumband::class, 'id_drumband', 'id');
    }
}
