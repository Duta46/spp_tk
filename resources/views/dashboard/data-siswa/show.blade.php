@extends('layouts.dashboard')

@section('title', 'Detail Data Siswa')

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Detail Siswa</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Detail Data Siswa
                    </div>
                    <div class="card-body m-3">
                        <div class="d-flex">
                            <p class="mr-4">Nama Siswa : </p>
                            <p>{{ $siswa->nama }}</p>
                        </div>

                        <div class="d-flex">
                            <p class="mr-4">NISN : </p>
                            <p>{{ $siswa->nisn }}</p>
                        </div>

                        <div class="d-flex">
                            <p class="mr-4">NIS : </p>
                            <p>{{ $siswa->nis }}</p>
                        </div>

                        <div class="d-flex">
                            <p class="mr-4">Kelas : </p>
                            <p>{{ $siswa->kelas->nama_kelas }}</p>
                        </div>

                        <div class="d-flex">
                            <p class="mr-4">Nomer Telepon : </p>
                            <p>{{ $siswa->nomor_telp }}</p>
                        </div>

                        <div class="d-flex">
                            <p class="mr-4">Alamat : </p>
                            <p>{{ $siswa->alamat }}</p>
                        </div>

                        <div class="d-flex">
                            <p class="mr-4">Status Pembayaran Ijazah : </p>
                            <p>{{ $siswa->status_ijazah }}</p>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
