@extends('layouts.dashboard')

@section('title', 'Edit Tabungan Siswa')

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Pembayaran</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="card-title">Edit Tabungan Siswa</div>

                    <form method="post" action="{{ url('dashboard/tabungan-siswa', $edit->id) }}">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                value="{{ $edit->siswa->nama }}">
                            <span class="text-danger">
                                @error('nisn')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label>Saldo</label>
                            <input type="number" class="form-control @error('saldo') is-invalid @enderror"
                                name="saldo" value="{{ $edit->saldo }}">
                            <span class="text-danger">
                                @error('saldo')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <a href="{{ url('dashboard/tabungan-siswa') }}" class="btn btn-primary btn-rounded">
                            <i class="mdi mdi-chevron-left"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-success btn-rounded float-right">
                            <i class="mdi mdi-check"></i> Simpan
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
