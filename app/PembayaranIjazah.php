<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembayaranIjazah extends Model
{
    use SoftDeletes;
    protected $table = 'pembayaran_ijazahs';

    protected $fillable = [
        'id_petugas',
        'id_siswa',
        'id_ijazah',
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

    public function ijazah()
    {
        return $this->belongsTo(Ijazah::class, 'id_ijazah', 'id');
    }

}
