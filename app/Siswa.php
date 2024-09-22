<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
         'nisn', 'nis', 'nama', 'id_kelas', 'nomor_telp', 'alamat', 'id_spp', 'status_ijazah'
    ];

   /**
   * Belongs To Siswa -> Spp
   *
   * @return void
   */
    public function spp()
    {
         return $this->belongsTo(Spp::class,'id_spp','id');
    }

   public function pembayaran()
   {
        return  $this->hasMany(Pembayaran::class,'id_spp');
   }

    public function kelas()
    {
        return  $this->belongsTo(Kelas::class,'id_kelas');
    }

   public function tabunganSiswa()
   {
    return $this->hasMany(TabunganSiswa::class);
   }

   public function pembayaranBekal()
   {
    return $this->hasMany(PembayaranBekal::class);
   }

   public function pembayaranPotab()
   {
    return $this->hasMany(PembayaranPotab::class);
   }

   public function PembayaranIjazah()
   {
        return $this->hasMany(PembayaranIjazah::class);
   }

   public function PembayaranOutbond()
   {
        return $this->hasMany(PembayaranOutbond::class);
   }

   public function PembayaranDrumband()
   {
        return $this->hasMany(PembayaranDrumband::class);
   }

   public function PembayaranKegiatan()
   {
        return $this->hasMany(PembayaranKegiatan::class);
   }

}
