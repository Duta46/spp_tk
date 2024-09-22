@extends('layouts.dashboard')

@section('title', 'Edit Pembayaran Potab')

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Pembayaran Potab</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="card-title">Edit Pembayaran Potab</div>

                    <form method="post" action="{{ url('/dashboard/pembayaran-potab', $edit->id) }}">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label>NISN Siswa</label>
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn"
                                value="{{ $edit->siswa->nisn }}">
                            <span class="text-danger">
                                @error('nisn')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">
                                    Potab
                                </label>
                            </div>
                            <select name="id_potab" class="custom-select @error('id_potab') is-invalid @enderror"
                                {{ count($potab) == 0 ? 'disabled' : '' }}>
                                @if (count($potab) == 0)
                                    <option>Pilihan tidak ada</option>
                                @else
                                    <option value="">Silahkan Pilih</option>
                                    @foreach ($potab as $value)
                                        <option value="{{ $value->id }}"
                                            {{ $edit->id_potab == $value->id ? 'selected' : '' }}>
                                            {{ 'Tahun ' . $value->tahun . ' - ' . 'Rp' . $value->nominal }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <span class="text-danger">
                            @error('id_potab')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="form-group">
                            <label>Jumlah Bayar</label>
                            <input type="text" class="form-control @error('jumlah_bayar') is-invalid @enderror"
                                name="jumlah_bayar" value="{{ $edit->jumlah_bayar }}">
                            <span class="text-danger">
                                @error('jumlah_bayar')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <a href="{{ url('/dashboard/pembayaran-potab') }}" class="btn btn-primary btn-rounded">
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
