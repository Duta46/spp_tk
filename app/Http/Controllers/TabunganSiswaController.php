<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TabunganSiswa;
use App\Siswa;
use App\User;
use PDF;
use Alert;

class TabunganSiswaController extends Controller
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
            'tabungan' => TabunganSiswa::orderBy('id', 'DESC')->paginate(10),
            'user' => User::find(auth()->user()->id)
        ];

        return view('dashboard.tabungan-siswa.index', $data);
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
            'nama' => 'required',
            'saldo' => 'required',
        ], $message);

        if (Siswa::where('nama', $request->nama)->exists() == false):
            Alert::error('Terjadi Kesalahan!', 'Siswa dengan Nama ini Tidak di Temukan');
            return back();
            exit;
        endif;


        $siswa = Siswa::where('nama', $request->nama)->get();

        foreach ($siswa as $val) {
            $id_siswa = $val->id;
        }

        TabunganSiswa::create([
            'id_petugas' => auth()->user()->id,
            'id_siswa' => $id_siswa,
            'saldo' => $request->saldo,
        ]);

        Alert::success('Berhasil!', 'Tabungan Berhasil di Tambahkan!');

        return back();
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
            'edit' => TabunganSiswa::find($id),
            'user' => User::find(auth()->user()->id)
        ];

        return view('dashboard.tabungan-siswa.edit', $data);
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
            'nama' => 'required',
            'saldo' => 'required',
        ], $message);

        $tabungan = TabunganSiswa::find($id);

        $tabungan->update([
            'nama' => $request->nama,
            'saldo' => $request->saldo,
        ]);

        if (Siswa::where('nama', $request->nama)->exists() == false):
            Alert::error('Terjadi Kesalahan!', 'Siswa dengan Nama ini Tidak di Temukan');
            return back();
            exit;
        endif;

        if ($request->nama != $tabungan->siswa->nama) :
            $siswa = Siswa::where('nama', $request->nama)->get();

            foreach ($siswa as $val) {
                $id_siswa = $val->id;
            }

            $tabungan->update([
                'id_siswa' => $id_siswa,
            ]);
        endif;

        Alert::success('Berhasil!', 'Tabungan berhasil di Edit');
        return redirect('/dashboard/tabungan-siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (TabunganSiswa::find($id)->delete()) :
            Alert::success('Berhasil!', 'Tabungan Siswa Berhasil di Hapus!');
        else :
            Alert::success('Terjadi Kesalahan!', 'Tabungan Siswa Gagal di Hapus');
        endif;

        return back();
    }

    public function cetakPDF($id)
    {
        // Ambil data tabungan siswa berdasarkan ID
        $tabunganSiswa = TabunganSiswa::with('users', 'siswa')->findOrFail($id);

        // Buat view untuk PDF
        $pdf = PDF::loadView('dashboard.tabungan-siswa.pdf', compact('tabunganSiswa'));

        // Unduh file PDF
        return $pdf->download('tabungan_siswa_' . $tabunganSiswa->siswa->nama . '.pdf');
    }
}
