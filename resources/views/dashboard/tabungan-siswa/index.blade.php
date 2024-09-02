@extends('layouts.dashboard')

@section('title', 'Tabungan Siswa')

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Tabungan Siswa</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="card-title">Tabungan Siswa</div>

                    <form method="post" action="{{ url('/dashboard/tabungan-siswa') }}">
                        @csrf

                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input type="text" class="form-control value="{{ old('nama') }}" @error('nama') is-invalid @enderror" name="nama">
                            <span class="text-danger">
                                @error('nama')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        {{-- <div class="input-group mb-3">
                        <div class="input-group-prepend">
                           <label class="input-group-text">
                              SPP Bulan
                           </label>
                        </div>
                        <select class="custom-select @error('spp_bulan') is-invalid @enderror" name="spp_bulan">

                              <option value="">Silahkan Pilih</option>
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
                     <span class="text-danger">@error('spp_bulan') {{ $message }} @enderror</span> --}}

                        <div class="form-group">
                            <label>Saldo</label>
                            <input type="number" class="form-control value="{{ old('saldo') }}" @error('saldo') is-invalid @enderror" name="saldo">
                            <span class="text-danger">
                                @error('saldo')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <button type="submit" class="btn btn-success btn-rounded float-right">
                            <i class="mdi mdi-check"></i> Simpan
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="card-title">Data Tabungan Siswa</div>

                    <div class="table-responsive mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">PETUGAS</th>
                                    <th scope="col">NAMA SISWA</th>
                                    <th scope="col">SALDO</th>
                                    <th scope="col">MULAI MENABUNG</th>
                                    <th scope="col">UPDATE TABUNGAN</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($tabungan as $value)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $value->users->name }}</td>
                                        <td>{{ $value->siswa->nama }}</td>
                                        <td>{{ $value->saldo }}</td>
                                        <td>{{ $value->created_at->format('d M, Y') }}</td>
                                        <td>{{ $value->updated_at->format('d M, Y') }}</td>
                                        <td>
                                            <div class="hide-menu">
                                                <a href="javascript:void(0)" class="text-dark" id="actiondd" role="button"
                                                    data-toggle="dropdown">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="actiondd">
                                                    <a class="dropdown-item"
                                                        href="{{ url('/dashboard/tabungan-siswa/' . $value->id . '/edit') }}"><i
                                                            class="ti-pencil"></i> Edit </a>
                                                    <form method="post"
                                                        action="{{ url('/dashboard/tabungan-siswa', $value->id) }}"
                                                        id="delete{{ $value->id }}">
                                                        @csrf
                                                        @method('delete')

                                                        <button type="button" class="dropdown-item"
                                                            onclick="deleteData({{ $value->id }})">
                                                            <i class="ti-trash"></i> Hapus
                                                        </button>

                                                    </form>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <! -- Pagination -->
                        @if ($tabungan->lastPage() != 1)
                            <div class="btn-group float-right">
                                <a href="{{ $tabungan->previousPageUrl() }}" class="btn btn-success">
                                    <i class="mdi mdi-chevron-left"></i>
                                </a>
                                @for ($i = 1; $i <= $tabungan->lastPage(); $i++)
                                    <a class="btn btn-success {{ $i == $tabungan->currentPage() ? 'active' : '' }}"
                                        href="{{ $tabungan->url($i) }}">{{ $i }}</a>
                                @endfor
                                <a href="{{ $tabungan->nextPageUrl() }}" class="btn btn-success">
                                    <i class="mdi mdi-chevron-right"></i>
                                </a>
                            </div>
                        @endif
                        <!-- End Pagination -->

                        @if (count($tabungan) == 0)
                            <div class="text-center">Tidak ada data!</div>
                        @endif

                </div>
            </div>

        </div>
    </div>

@endsection

@section('sweet')

    function deleteData(id){
    Swal.fire({
    title: 'PERINGATAN!',
    text: "Yakin ingin menghapus tabungan siswa?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yakin',
    cancelButtonText: 'Batal',
    }).then((result) => {
    if (result.value) {
    $('#delete'+id).submit();
    }
    })
    }

@endsection
