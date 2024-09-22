@extends('layouts.dashboard')

@section('title', 'Edit Data Potab')

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Data Potab</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="card-title">Edit Data Potab</div>

                    <form method="post" action="{{ url('/dashboard/potab', $potab->id) }}">
                        @csrf
                        @method('put')

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">
                                    Tahun
                                </label>
                            </div>
                            <select name="id_tahun_potab" class="custom-select @error('id_tahun_bekal') is-invalid @enderror"
                                {{ count($tahunPotab) == 0 ? 'disabled' : '' }}>
                                @if (count($tahunPotab) == 0)
                                    <option>Pilihan tidak ada</option>
                                @else
                                    <option value="">Silahkan Pilih</option>
                                    @foreach ($tahunPotab as $value)
                                        <option value="{{ $value->id }}"
                                            {{ $potab->id_tahun_potab == $value->id ? 'selected' : '' }}>
                                            {{ $value->tahun }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <span class="text-danger">
                            @error('id_tahun_potab')
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
                                <option value="januari" {{ $potab->bulan == 'januari' ? 'selected' : '' }}>Januari
                                </option>
                                <option value="februari" {{ $potab->bulan == 'februari' ? 'selected' : '' }}>Februari
                                </option>
                                <option value="maret" {{ $potab->bulan == 'maret' ? 'selected' : '' }}>Maret</option>
                                <option value="april" {{ $potab->bulan == 'april' ? 'selected' : '' }}>April</option>
                                <option value="mei" {{ $potab->bulan == 'mei' ? 'selected' : '' }}>Mei</option>
                                <option value="juni" {{ $potab->bulan == 'juni' ? 'selected' : '' }}>Juni</option>
                                <option value="juli" {{ $potab->bulan == 'juli' ? 'selected' : '' }}>Juli</option>
                                <option value="agustus" {{ $potab->bulan == 'agustus' ? 'selected' : '' }}>Agustus
                                </option>
                                <option value="september" {{ $potab->bulan == 'september' ? 'selected' : '' }}>September
                                </option>
                                <option value="oktober" {{ $potab->bulan == 'oktober' ? 'selected' : '' }}>Oktober
                                </option>
                                <option value="november" {{ $potab->bulan == 'november' ? 'selected' : '' }}>November
                                </option>
                                <option value="desember" {{ $potab->bulan == 'desember' ? 'selected' : '' }}>Desember
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
                                name="nominal" value="{{ $potab->nominal }}">
                            <span class="text-danger">
                                @error('nominal')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <a href="{{ url('/dashboard/potab') }}" class="btn btn-primary btn-rounded">
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
