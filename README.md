<p align="center">
    <h1>Aplikasi Pembayaran SPP</h1>
</p>

## Tentang Aplikasi Pembayaran SPP

Aplikasi ini memiliki 3 hak akses level login, yang diantaranya :

Level Admin

-   Login
-   Logout
-   CRUD data siswa
-   CRUD data petugas
-   CRUD data Kelas
-   CRUD data SPP
-   Entri Transaksi Pembayaran
-   Lihat Histori Pembayaran
-   Generate Laporan

Level Petugas

-   Login
-   Logout
-   Entri Transaksi Pembayaran
-   Lihat Histori Pembayaran

Level Siswa

-   Login
-   Logout
-   Lihat Histori Pembayaran

$ composer update <br>
$ php artisan migrate --seed <br>
$ php artisan serve <br>

Catatan :
lakukan terlebih dahulu pembuatan database dengan nama db_spp sebelum melakukan migrate.

## Akun Untuk Login

Level Admin

-   email : admin@gmail.com
-   password : admin

Level Petugas

-   email : petugas@gmail.com
-   password : petugas

## Penutup

Aplikasi ini dibuat untuk memenuhi Kerja praktek.
