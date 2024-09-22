<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ijazah;
use App\User;
use Alert;

class IjazahController extends Controller
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
            'ijazah' => Ijazah::orderBy('id', 'DESC')->paginate(10),
            'user' => User::find(auth()->user()->id)
        ];

        return view('dashboard.data-ijazah.index', $data);
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

        $messages = [
            'required' => ':attribute tidak boleh kosong!',
            'numeric' => ':attribute harus berupa angka!',
            'min' => ':attribute minimal harus :min angka!',
            'max' => ':attribute maksimal harus :max angka!',
            'integer' => ':attribute harus berupa nilai uang tanpa titik!'
        ];

        $validasi = $request->validate([
            'tahun' => 'required|min:4|max:4',
            'nominal' => 'required|integer',
        ], $messages);

        if ($validasi) :
            $store = Ijazah::create([
                'tahun' => $request->tahun,
                'nominal' => $request->nominal,
            ]);

            if ($store) :
                Alert::success('Berhasil!', 'Data Berhasil Ditambahkan');
            else :
                Alert::error('Gagal!', 'Data Gagal Ditambahkan');
            endif;
        endif;

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
            'edit' => Ijazah::find($id),
            'user' => User::find(auth()->user()->id)
        ];

        return view('dashboard.data-ijazah.edit', $data);
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
        if ($update = Ijazah::find($id)) :
            $status = $update->update([
                'tahun' => $request->tahun,
                'nominal' => $request->nominal
            ]);
            if ($status) :
                Alert::success('Berhasil!', 'Data Berhasil di Edit');
            else :
                Alert::error('Terjadi Kesalahan!', 'Data Gagal di Edit');
                return back();
            endif;
        endif;

        return redirect('dashboard/data-ijazah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Ijazah::find($id)->delete()) :
            Alert::success('Berhasil!', 'Data Berhasil Dihapus');
        else :
            Alert::error('Berhasil!', 'Data Gagal Dihapus');
        endif;

        return back();
    }
}
