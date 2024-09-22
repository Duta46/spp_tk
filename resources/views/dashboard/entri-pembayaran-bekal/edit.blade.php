@extends('layouts.dashboard')

@section('title', 'Edit Pembayaran Bekal')

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Pembayaran Bekal</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="card-title">Edit Pembayaran Bekal</div>

                    <form method="post" action="{{ url('/dashboard/pembayaran-bekal', $edit->id) }}">
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
                                    Bekal
                                </label>
                            </div>
                            <select name="id_bekal" class="custom-select @error('id_bekal') is-invalid @enderror"
                                {{ count($bekal) == 0 ? 'disabled' : '' }}>
                                @if (count($bekal) == 0)
                                    <option>Pilihan tidak ada</option>
                                @else
                                    <option value="">Silahkan Pilih</option>
                                    @foreach ($bekal as $value)
                                        <option value="{{ $value->id }}"
                                            {{ $edit->id_bekal == $value->id ? 'selected' : '' }}>
                                            {{ 'Tahun ' . $value->tahun . ' - ' . 'Rp' . $value->nominal }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <span class="text-danger">
                            @error('id_bekal')
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
                        <a href="{{ url('/dashboard/pembayaran-bekal') }}" class="btn btn-primary btn-rounded">
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
