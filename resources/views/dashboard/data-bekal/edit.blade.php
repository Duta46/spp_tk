@extends('layouts.dashboard')

@section('title', 'Edit Data Bekal')

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Data Bekal</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="card-title">Edit Data Bekal</div>

                    <form method="post" action="{{ url('/dashboard/bekal', $bekal->id) }}">
                        @csrf
                        @method('put')

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">
                                    Tahun
                                </label>
                            </div>
                            <select name="id_tahun_bekal" class="custom-select @error('id_tahun_bekal') is-invalid @enderror"
                                {{ count($tahunBekal) == 0 ? 'disabled' : '' }}>
                                @if (count($tahunBekal) == 0)
                                    <option>Pilihan tidak ada</option>
                                @else
                                    <option value="">Silahkan Pilih</option>
                                    @foreach ($tahunBekal as $value)
                                        <option value="{{ $value->id }}"
                                            {{ $bekal->id_tahun_bekal == $value->id ? 'selected' : '' }}>
                                            {{ $value->tahun }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <span class="text-danger">
                            @error('id_tahun_bekal')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">
                                    bulan
                                </label>
                            </div>
                            <select class="custom-select @error('bulan') is-invalid @enderror" name="bulan">
                                <option value="">Silahkan Pilih</option>
                                <option value="januari" {{ $bekal->bulan == 'januari' ? 'selected' : '' }}>Januari
                                </option>
                                <option value="februari" {{ $bekal->bulan == 'februari' ? 'selected' : '' }}>Februari
                                </option>
                                <option value="maret" {{ $bekal->bulan == 'maret' ? 'selected' : '' }}>Maret</option>
                                <option value="april" {{ $bekal->bulan == 'april' ? 'selected' : '' }}>April</option>
                                <option value="mei" {{ $bekal->bulan == 'mei' ? 'selected' : '' }}>Mei</option>
                                <option value="juni" {{ $bekal->bulan == 'juni' ? 'selected' : '' }}>Juni</option>
                                <option value="juli" {{ $bekal->bulan == 'juli' ? 'selected' : '' }}>Juli</option>
                                <option value="agustus" {{ $bekal->bulan == 'agustus' ? 'selected' : '' }}>Agustus
                                </option>
                                <option value="september" {{ $bekal->bulan == 'september' ? 'selected' : '' }}>September
                                </option>
                                <option value="oktober" {{ $bekal->bulan == 'oktober' ? 'selected' : '' }}>Oktober
                                </option>
                                <option value="november" {{ $bekal->bulan == 'november' ? 'selected' : '' }}>November
                                </option>
                                <option value="desember" {{ $bekal->bulan == 'desember' ? 'selected' : '' }}>Desember
                                </option>
                            </select>
                        </div>
                        <span class="text-danger">
                            @error('bulan')
                                {{ $message }}
                            @enderror
                        </span>


                        <div class="form-group">
                            <label>Nominal</label>
                            <input type="text" class="form-control @error('nominal') is-invalid @enderror"
                                name="nominal" value="{{ $bekal->nominal }}">
                            <span class="text-danger">
                                @error('nominal')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <a href="{{ url('/dashboard/bekal') }}" class="btn btn-primary btn-rounded">
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
