<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kegiatan;
use App\User;
use Alert;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'kegiatan' => Kegiatan::orderBy('id', 'DESC')->paginate(10),
            'user' => User::find(auth()->user()->id)
        ];

         return view('dashboard.data-kegiatan.index', $data);
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
            'nominal' => 'required|integer',
            'keterangan' => 'required',
        ], $messages);

       if($validasi) :
           $store = Kegiatan::create([
               'nominal' => $request->nominal,
               'keterangan' => $request->keterangan,
           ]);

           if($store) :
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
            'edit' => Kegiatan::find($id),
             'user' => User::find(auth()->user()->id)
        ];

        return view('dashboard.data-kegiatan.edit', $data);
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
        if($update = Kegiatan::find($id)) :
            $status = $update->update([
                'nominal' => $request->nominal,
               'keterangan' => $request->keterangan,
            ]);
            if($status) :
                   Alert::success('Berhasil!', 'Data Berhasil di Edit');
                else :
                  Alert::error('Terjadi Kesalahan!', 'Data Gagal di Edit');
                  return back();
               endif;
         endif;

         return redirect('dashboard/data-kegiatan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Kegiatan::find($id)->delete()) :
            Alert::success('Berhasil!', 'Data Berhasil Dihapus');
        else :
            Alert::error('Berhasil!', 'Data Gagal Dihapus');
        endif;

        return back();
    }
}
