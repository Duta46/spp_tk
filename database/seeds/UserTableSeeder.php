<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Siswa;
use App\Kelas;
use App\Spp;
use App\Pembayaran;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'level' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
         ]);
         
         User::create([
            'name' => 'petugas',
            'email' => 'petugas@gmail.com',
            'password' => Hash::make('petugas'),
            'level' => 'petugas',
            'created_at' => now(),
            'updated_at' => now()
         ]);

        Kelas::create([
            'nama_kelas' => 'TK A'
        ]);

        Spp::create([
            'tahun' => 2024,
            'nominal' => 250000
        ]);
    }
}
