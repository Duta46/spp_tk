<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ProfilePhoto;
use Illuminate\Support\Facades\Storage;
use Alert;

class ChangePhotoController extends Controller
{

    public function __construct(){
        $this->middleware([
           'auth',
           'privilege:admin'
        ]);
   }

    public function index()
    {
        $user = User::find(auth()->user()->id);
        $photos = ProfilePhoto::get();

        return view('dashboard.change-photo.index', compact('user'));
    }

    public function updatePhoto(Request $request)
    {
       // Validasi file upload (maksimal 2MB)
    $request->validate([
        'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
    ]);

    // Simpan file baru ke storage
    $file = $request->file('profile_photo');
    $path = $file->store('profile_photos', 'public');

    // Hapus file yang sudah ada sebelumnya jika ada
    $lastPhoto = ProfilePhoto::latest()->first(); // Mendapatkan file terakhir yang diupload

    if ($lastPhoto) {
        Storage::disk('public')->delete($lastPhoto->profile_photo); // Hapus file dari storage
        $lastPhoto->delete(); // Hapus data file dari database
    }

    // Simpan path file baru ke database
    ProfilePhoto::create([
        'profile_photo' => $path,
    ]);

    // Menampilkan alert sukses
    Alert::success('Berhasil', 'Foto profil berhasil diubah.');

    return redirect()->back();
    }
}
