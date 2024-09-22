@extends('layouts.dashboard')

@section('title', 'Tambah Bekal')

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Bekal</li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">{{ __('Tambah Bekal') }}</div>

                    <form method="post" action="{{ url('/dashboard/bekal') }}">
                        @csrf

                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="number" class="form-control @error('tahun') is-invalid @enderror" name="tahun"
                                value="{{ old('tahun') }}">
                            <span class="text-danger">
                                @error('tahun')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">
                                    Bulan
                                </label>
                            </div>
                            <select class="custom-select @error('bulan') is-invalid @enderror" name="bulan">

                                <option value="" hidden>Silahkan Pilih</option>
                                <option value="januari">Januari</option>
                                <option value="februari">Februari</option>
                                <option value="maret">Maret</option>
                                <option value="april">April</option>
                                <option value="mei">Mei</option>
                                <option value="juni">Juni</option>
                                <option value="juli">Juli</option>
                                <option value="agustus">Agustus</option>
                                <option value="september">September</option>
                                <option value="oktober">Oktober</option>
                                <option value="november">November</option>
                                <option value="desember">Desember</option>
                            </select>
                        </div>
                        <span class="text-danger">
                            @error('bulan')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="form-group">
                            <label>Nominal</label>
                            <input type="number" class="form-control @error('nominal') is-invalid @enderror" name="nominal"
                                value="{{ old('nominal') }}">
                            <span class="text-danger">
                                @error('nominal')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="border-top">

                            <button type="submit" class="btn btn-success btn-rounded float-right mt-3">
                                <i class="mdi mdi-check"></i> {{ __('Simpan') }}
                            </button>

                            <a href="{{ url('/dashboard/bekal') }}" class="btn btn-primary btn-rounded mt-3">
                                <i class="mdi mdi-chevron-left"></i> {{ __('Kembali') }}
                            </a>
                    </form>

                </div>
            </div>

        </div>
    </div>
    </div>

@endsection
