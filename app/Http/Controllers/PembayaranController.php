<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembayaran;
use App\User;
use App\Siswa;
use App\TabunganSiswa;
use Alert;

class PembayaranController extends Controller
{

    public function __construct()
    {
        $this->middleware([
            'auth',
            'privilege:admin&petugas'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pembayaran' => Pembayaran::orderBy('id', 'DESC')->paginate(10),
            'user' => User::find(auth()->user()->id)
        ];

        return view('dashboard.entri-pembayaran.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {

        $message = [
            'required' => ':attribute harus di isi',
            'numeric' => ':attribute harus berupa angka',
            'min' => ':attribute minimal harus :min angka',
            'max' => ':attribute maksimal harus :max angka',
        ];

        $req->validate([
            'nisn' => 'required',
            'spp_bulan' => 'required',
            'jumlah_bayar' => 'required|numeric',
        ], $message);

        if (Siswa::where('nisn', $req->nisn)->exists() == false):
            Alert::error('Terjadi Kesalahan!', 'Siswa dengan NISN ini Tidak di Temukan');
            return back();
            exit;
        endif;


        $siswa = Siswa::where('nisn', $req->nisn)->first();
        $id_siswa = $siswa->id;

        // Cek saldo tabungan siswa
        $tabungan = TabunganSiswa::where('id_siswa', $id_siswa)->first();

        // Pastikan tabungan ditemukan dan saldo cukup
        if ($tabungan && $tabungan->saldo >= $req->jumlah_bayar) {
            // Kurangi saldo tabungan siswa
            $tabungan->saldo -= $req->jumlah_bayar;
            $tabungan->save();

            //  foreach($siswa as $val){
            //     $id_siswa = $val->id;
            //  }

            Pembayaran::create([
                'id_petugas' => auth()->user()->id,
                'id_siswa' => $id_siswa,
                'spp_bulan' => $req->spp_bulan,
                'jumlah_bayar' => $req->jumlah_bayar,
            ]);

            Alert::success('Berhasil!', 'Pembayaran Berhasil di Tambahkan!');

            return back();
        } else {
            // Saldo tidak cukup atau tabungan tidak ditemukan
            return back()->withErrors(['jumlah_bayar' => 'Saldo tabungan tidak mencukupi untuk melakukan pembayaran SPP.'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'edit' => Pembayaran::find($id),
            'user' => User::find(auth()->user()->id)
        ];

        return view('dashboard.entri-pembayaran.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $message = [
            'required' => ':attribute harus di isi',
            'numeric' => ':attribute harus berupa angka',
            'min' => ':attribute minimal harus :min angka',
            'max' => ':attribute maksimal harus :max angka',
        ];

        $req->validate([
            'nisn' => 'required',
            'spp_bulan' => 'required',
            'jumlah_bayar' => 'required|numeric'
        ], $message);

        $pembayaran = Pembayaran::find($id);

        // Cek siswa dengan NISN
        if (!Siswa::where('nisn', $req->nisn)->exists()) {
            Alert::error('Terjadi Kesalahan!', 'Siswa dengan NISN ini Tidak di Temukan');
            return back()->withInput();
        }

        $siswa = Siswa::where('nisn', $req->nisn)->first();
        $tabungan = TabunganSiswa::where('id_siswa', $siswa->id)->first();

        // Hitung perbedaan jumlah pembayaran
        $difference = $pembayaran->jumlah_bayar - $req->jumlah_bayar;

        if ($difference > 0 && $tabungan) {
            // Jika pembayaran baru lebih kecil, kembalikan selisihnya ke saldo tabungan
            $tabungan->saldo += $difference;
            $tabungan->save();
        }

        // Update data pembayaran
        $pembayaran->update([
            'spp_bulan' => $req->spp_bulan,
            'jumlah_bayar' => $req->jumlah_bayar,
            'id_siswa' => $siswa->id,
        ]);

        Alert::success('Berhasil!', 'Pembayaran berhasil di Edit.');
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Pembayaran::find($id)->delete()) :
            Alert::success('Berhasil!', 'Pembayaran Berhasil di Hapus!');
        else :
            Alert::success('Terjadi Kesalahan!', 'Pembayaran Gagal di Tambahkan!');
        endif;

        return back();
    }
}
