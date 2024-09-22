<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryTabungan extends Model
{
    protected $table = 'history_tabungans';

    protected $fillable = [
        'id_petugas',
        'id_siswa',
        'tipe_transaksi',
        'saldo_akhir'
    ];

    public function users()
    {
         return $this->belongsTo(User::class,'id_petugas', 'id');
    }

    public function siswa()
    {
         return $this->belongsTo(Siswa::class,'id_siswa', 'id');
    }


}
