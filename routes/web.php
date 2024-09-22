<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\PembayaranKegiatanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TabunganSiswaController;
use App\Http\Controllers\ChangePhotoController;


Route::get('/', function () {
    return view('auth.login ');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::resource('/dashboard/data-siswa', 'SiswaController');
Route::resource('/dashboard/data-kelas', 'KelasController');
Route::resource('/dashboard/data-spp', 'SppController');
Route::resource('/dashboard/data-petugas', 'PetugasController');
Route::resource('/dashboard/pembayaran', 'PembayaranController');
Route::resource('/dashboard/histori', 'HistoryController');
Route::resource('/dashboard/tabungan-siswa', 'TabunganSiswaController');
Route::resource('/dashboard/data-bekal', 'BekalController');
Route::resource('/dashboard/data-potab', 'PotabController');
Route::resource('/dashboard/data-ijazah', 'IjazahController');
Route::resource('/dashboard/data-ujian', 'UjianController');
Route::resource('/dashboard/data-kegiatan', 'KegiatanController');
Route::resource('/dashboard/data-daftar-ulang', 'DaftarUlangController');
Route::resource('/dashboard/data-drumband', 'DrumbandController');
Route::resource('/dashboard/data-outbond', 'OutbondController');
Route::resource('/dashboard/pembayaran-bekal', 'PembayaranBekalController');
Route::resource('/dashboard/pembayaran-potab', 'PembayaranPotabController');
Route::resource('/dashboard/pembayaran-ijazah', 'PembayaranIJazahController');
Route::resource('/dashboard/pembayaran-outbond', 'PembayaranOutbondController');
Route::resource('/dashboard/pembayaran-drumband', 'PembayaranDrumbandController');
Route::resource('/dashboard/pembayaran-kegiatan', 'PembayaranKegiatanController');

Route::get('/dashboard/tabungan-siswa/{id}/cetakPDF', [TabunganSiswaController::class, 'cetakPDF']);

Route::get('/dashboard/laporan', 'LaporanController@index');
Route::get('/dashboard/laporan/create', 'LaporanController@create');

Route::get('/dashboard/foto-profil', [ChangePhotoController::class, 'index']);
Route::post('/dashboard/foto-profil', [ChangePhotoController::class, 'updatePhoto'])->name('profile.updatePhoto');

Route::get('/login/siswa', 'SiswaLoginController@siswaLogin');
Route::post('/login/siswa/proses', 'SiswaLoginController@login');
Route::get('/dashboard/siswa/histori', 'SiswaLoginController@index');
Route::get('/siswa/logout', 'SiswaLoginController@logout');
