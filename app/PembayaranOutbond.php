<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembayaranOutbond extends Model
{
    use SoftDeletes;
    protected $table = 'pembayaran_outbonds';

    protected $fillable = [
        'id_petugas',
        'id_siswa',
        'id_outbond',
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

    public function outbond()
    {
        return $this->belongsTo(Outbond::class, 'id_outbond', 'id');
    }
}
