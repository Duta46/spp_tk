<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Potab;
use App\PembayaranPotab;
use App\TabunganSiswa;
use App\User;
use App\Siswa;
use Alert;

class PembayaranPotabController extends Controller
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
            'potabs' => Potab::get(),
            'pembayaran' => PembayaranPotab::orderBy('id', 'DESC')->paginate(10),
            'user' => User::find(auth()->user()->id)
        ];

        return view('dashboard.entri-pembayaran-potab.index', $data);
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
    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute harus di isi',
            'numeric' => ':attribute harus berupa angka',
            'min' => ':attribute minimal harus :min angka',
            'max' => ':attribute maksimal harus :max angka',
        ];

        $request->validate([
            'nisn' => 'required',
            'id_potab' => 'required',
            'jumlah_bayar' => 'required|numeric',
        ], $message);

        if (Siswa::where('nisn', $request->nisn)->exists() == false):
            Alert::error('Terjadi Kesalahan!', 'Siswa dengan NISN ini Tidak di Temukan');
            return back();
            exit;
        endif;


        $siswa = Siswa::where('nisn', $request->nisn)->first();
        $id_siswa = $siswa->id;

        // Cek saldo tabungan siswa
        $tabungan = TabunganSiswa::where('id_siswa', $id_siswa)->first();

        // Pastikan tabungan ditemukan dan saldo cukup
        if ($tabungan && $tabungan->saldo >= $request->jumlah_bayar) {
            // Kurangi saldo tabungan siswa
            $tabungan->saldo -= $request->jumlah_bayar;
            $tabungan->save();

            //  foreach($siswa as $val){
            //     $id_siswa = $val->id;
            //  }

            PembayaranPotab::create([
                'id_petugas' => auth()->user()->id,
                'id_siswa' => $id_siswa,
                'id_potab' => $request->id_potab,
                'jumlah_bayar' => $request->jumlah_bayar,
            ]);

            Alert::success('Berhasil!', 'Pembayaran Potab Berhasil di Tambahkan!');

            return back();
        } else {
            // Saldo tidak cukup atau tabungan tidak ditemukan
            return back()->withErrors(['jumlah_bayar' => 'Saldo tabungan tidak mencukupi untuk melakukan pembayaran Potab.'])->withInput();
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
            'edit' => PembayaranPotab::find($id),
            'potab' => Potab::get(),
            'user' => User::find(auth()->user()->id)
        ];

        return view('dashboard.entri-pembayaran-potab.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = [
            'required' => ':attribute harus di isi',
            'numeric' => ':attribute harus berupa angka',
            'min' => ':attribute minimal harus :min angka',
            'max' => ':attribute maksimal harus :max angka',
        ];

        $request->validate([
            'nisn' => 'required',
            'id_bekal' => 'required',
            'jumlah_bayar' => 'required|numeric'
        ], $message);

        $pembayaran = PembayaranPotab::find($id);

        // Cek siswa dengan NISN
        if (!Siswa::where('nisn', $request->nisn)->exists()) {
            Alert::error('Terjadi Kesalahan!', 'Siswa dengan NISN ini Tidak di Temukan');
            return back()->withInput();
        }

        $siswa = Siswa::where('nisn', $request->nisn)->first();
        $tabungan = TabunganSiswa::where('id_siswa', $siswa->id)->first();

        // Hitung perbedaan jumlah pembayaran
        $difference = $pembayaran->jumlah_bayar - $request->jumlah_bayar;

        if ($difference > 0 && $tabungan) {
            // Jika pembayaran baru lebih kecil, kembalikan selisihnya ke saldo tabungan
            $tabungan->saldo += $difference;
            $tabungan->save();
        }

        // Update data pembayaran
        $pembayaran->update([
            'id_potab' => $request->id_potab,
            'jumlah_bayar' => $request->jumlah_bayar,
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
        if (PembayaranPotab::find($id)->delete()) :
            Alert::success('Berhasil!', 'Pembayaran Berhasil di Hapus!');
        else :
            Alert::success('Terjadi Kesalahan!', 'Pembayaran Gagal di Tambahkan!');
        endif;

        return back();
    }
}
