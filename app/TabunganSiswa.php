<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TabunganSiswa extends Model
{
    use SoftDeletes;

    protected $table = 'tabungan_siswas';

    protected $fillable = [
        'id_petugas',
        'id_siswa',
        'saldo',
    ];

    public function users()
    {
         return $this->belongsTo(User::class,'id_petugas', 'id');
    }

    public function siswa()
    {
         return $this->belongsTo(Siswa::class,'id_siswa','id','nama');
    }


}
