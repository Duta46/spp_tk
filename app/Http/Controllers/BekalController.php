<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bekal;
use App\User;
use Alert;

class BekalController extends Controller
{

    public function __construct()
    {
        $this->middleware([
            'auth',
            'privilege:admin'
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
            'bekal' => Bekal::orderBy('id', 'DESC')->paginate(10),
            'user' => User::find(auth()->user()->id)
        ];


        return view('dashboard.data-bekal.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'user' => User::find(auth()->user()->id),
            'bekal' => Bekal::all(),
        ];

        return view('dashboard.data-bekal.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong!',
            'numeric' => ':attribute harus berupa angka!',
            'min' => ':attribute minimal harus :min angka!',
            'max' => ':attribute maksimal harus :max angka!',
            'integer' => ':attribute harus berupa nilai uang tanpa titik!'
        ];

        $validasi = $request->validate([
            'tahun' => 'required',
            'bulan' => 'required',
            'nominal' => 'required|integer',
        ], $messages);

        if ($validasi) :
            $store = Bekal::create([
                'tahun' => $request->tahun,
                'bulan' => $request->bulan,
                'nominal' => $request->nominal,
            ]);



            if ($store) :
                Alert::success('Berhasil!', 'Data Berhasil Ditambahkan');
            else :
                Alert::error('Gagal!', 'Data Gagal Ditambahkan');
            endif;
        endif;

        return redirect('/dashboard/bekal');
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
            'user' => User::find(auth()->user()->id),
            'bekal' => Bekal::find($id),
        ];

        return view('dashboard.data-bekal.edit', $data);
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
        $messages = [
            'required' => ':attribute tidak boleh kosong!',
            'numeric' => ':attribute harus berupa angka!',
            'integer' => ':attribute harus berupa bilangan bulat!'
        ];

        $validasi = $request->validate([
            'tahun' => 'required',
            'bulan' => 'required',
            'nominal' => 'required|integer',
        ], $messages);

        if ($validasi) :
            $update = Bekal::find($id)->update([
                'tahun' => $request->tahun,
                'bulan' => $request->bulan,
                'nominal' => $request->nominal,
            ]);



            if ($update) :
                Alert::success('Berhasil!', 'Data Berhasil di Edit');
            else :
                Alert::error('Terjadi Kesalahan!', 'Data Gagal di Edit');
            endif;
        endif;

        return redirect('/dashboard/bekal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Bekal::find($id)->delete()) :
            Alert::success('Berhasil!', 'Data Berhasil di Hapus');
        else :
            Alert::error('Terjadi Kesalahan!', 'Data Gagal di Hapus');
        endif;

        return back();
    }
}
