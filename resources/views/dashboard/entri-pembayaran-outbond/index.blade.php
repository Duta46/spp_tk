@extends('layouts.dashboard')

@section('title', 'Pembayaran Outbond')

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Pembayaran Outbond</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="card-title">Entri Pembayaran Outbond</div>

                    <form method="post" action="{{ url('/dashboard/pembayaran-outbond') }}">
                        @csrf

                        <div class="form-group">
                            <label>NISN Siswa</label>
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn">
                            <span class="text-danger">
                                @error('nisn')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">
                                    Outbond
                                </label>
                            </div>
                            <select name="id_outbond" class="custom-select @error('id_outbond') is-invalid @enderror"
                                {{ count($outbonds) == 0 ? 'disabled' : '' }}>
                                @if (count($outbonds) == 0)
                                    <option>Pilihan tidak ada</option>
                                @else
                                    @foreach ($outbonds as $value)
                                        <option value="">Silahkan Pilih</option>
                                        <option value="{{ $value->id }}">
                                            {{ 'Tahun ' . $value->tahun . ' - ' . 'Rp ' . $value->nominal }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <span class="text-danger">
                            @error('id_outbond')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="form-group">
                            <label>Jumlah Bayar</label>
                            <input type="number" class="form-control @error('jumlah_bayar') is-invalid @enderror"
                                name="jumlah_bayar">
                            <span class="text-danger">
                                @error('jumlah_bayar')
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
                    <div class="card-title">Data Pembayaran Outbond</div>

                    <div class="table-responsive mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">PETUGAS</th>
                                    <th scope="col">NISN SISWA</th>
                                    <th scope="col">NAMA SISWA</th>
                                    <th scope="col">NOMINAL OUTBOND</th>
                                    <th scope="col">JUMLAH BAYAR</th>
                                    <th scope="col">TANGGAL BAYAR</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($pembayaran as $value)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $value->users->name }}</td>
                                        <td>{{ $value->siswa->nisn }}</td>
                                        <td>{{ $value->siswa->nama }}</td>
                                        <td>{{ $value->outbond->nominal }}</td>
                                        <td>{{ $value->jumlah_bayar }}</td>
                                        <td>{{ $value->created_at->format('d M, Y') }}</td>
                                        <td>
                                            <div class="hide-menu">
                                                <a href="javascript:void(0)" class="text-dark" id="actiondd" role="button"
                                                    data-toggle="dropdown">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="actiondd">
                                                    <a class="dropdown-item"
                                                        href="{{ url('/dashboard/pembayaran-outbond/' . $value->id . '/edit') }}"><i
                                                            class="ti-pencil"></i> Edit </a>
                                                    <form method="post"
                                                        action="{{ url('/dashboard/pembayaran-outbond', $value->id) }}"
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
                        @if ($pembayaran->lastPage() != 1)
                            <div class="btn-group float-right">
                                <a href="{{ $pembayaran->previousPageUrl() }}" class="btn btn-success">
                                    <i class="mdi mdi-chevron-left"></i>
                                </a>
                                @for ($i = 1; $i <= $pembayaran->lastPage(); $i++)
                                    <a class="btn btn-success {{ $i == $pembayaran->currentPage() ? 'active' : '' }}"
                                        href="{{ $pembayaran->url($i) }}">{{ $i }}</a>
                                @endfor
                                <a href="{{ $pembayaran->nextPageUrl() }}" class="btn btn-success">
                                    <i class="mdi mdi-chevron-right"></i>
                                </a>
                            </div>
                        @endif
                        <!-- End Pagination -->

                        @if (count($pembayaran) == 0)
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
    text: "Yakin ingin menghapus pembayaran outbond?",
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
