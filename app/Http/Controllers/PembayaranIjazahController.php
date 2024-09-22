<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PembayaranIjazah;
use App\Siswa;
use App\User;
use App\Ijazah;
use App\TabunganSiswa;
use Alert;

class PembayaranIjazahController extends Controller
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
            'ijazahs' => Ijazah::get(),
            'pembayaran' => PembayaranIjazah::orderBy('id', 'DESC')->paginate(10),
            'user' => User::find(auth()->user()->id)
        ];

        return view('dashboard.entri-pembayaran-ijazah.index', $data);
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
            'id_ijazah' => 'required',
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

            PembayaranIjazah::create([
                'id_petugas' => auth()->user()->id,
                'id_siswa' => $id_siswa,
                'id_ijazah' => $request->id_ijazah,
                'jumlah_bayar' => $request->jumlah_bayar,
            ]);

            $siswa->update([
                'status_ijazah' => 'Lunas'
            ]);


            Alert::success('Berhasil!', 'Pembayaran Ijazah Berhasil di Tambahkan!');

            return back();
        } else {
               // Saldo tidak cukup atau tabungan tidak ditemukan
        return back()->withErrors(['jumlah_bayar' => 'Saldo tabungan tidak mencukupi untuk melakukan pembayaran ijazah.'])->withInput();
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
            'edit' => PembayaranIjazah::find($id),
            'ijazah' => Ijazah::get(),
            'user' => User::find(auth()->user()->id)
        ];

        return view('dashboard.entri-pembayaran-ijazah.edit', $data);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
