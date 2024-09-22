@extends('layouts.dashboard')

@section('title', 'Data Kegiatan')

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Kegiatan</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">{{ __('Tambah Kegiatan') }}</div>

                    <form method="post" action="{{ url('/dashboard/data-kegiatan') }}">
                        @csrf

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

                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="5" name="keterangan">{{ old('keterangan') }}</textarea>
                            <span class="text-danger">
                                @error('keterangan')
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
                    <div class="card-title">Data Kegiatan</div>

                    <div class="table-responsive mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">NOMINAL</th>
                                    <th scope="col">KETERANGAN</th>
                                    <th scope="col">DIBUAT</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($kegiatan as $value)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $value->nominal }}</td>
                                        <td>{{ $value->keterangan }}</td>
                                        <td>{{ $value->created_at->format('d M, Y') }}</td>

                                        <td>
                                            <div class="hide-menu">
                                                <a href="javascript:void(0)" class="text-dark" id="actiondd" role="button"
                                                    data-toggle="dropdown">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="actiondd">
                                                    <a class="dropdown-item"
                                                        href="{{ url('dashboard/data-kegiatan/' . $value->id . '/edit') }}"><i
                                                            class="ti-pencil"></i> Edit </a>
                                                    <form method="post"
                                                        action="{{ url('dashboard/data-kegiatan', $value->id) }}"
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

                    <!-- Pagination -->
                    @if ($kegiatan->lastPage() != 1)
                        <div class="btn-group float-right">
                            <a href="{{ $kegiatan->previousPageUrl() }}" class="btn btn-success">
                                <i class="mdi mdi-chevron-left"></i>
                            </a>
                            @for ($i = 1; $i <= $kegiatan->lastPage(); $i++)
                                <a class="btn btn-success {{ $i == $kegiatan->currentPage() ? 'active' : '' }}"
                                    href="{{ $kegiatan->url($i) }}">{{ $i }}</a>
                            @endfor
                            <a href="{{ $kegiatan->nextPageUrl() }}" class="btn btn-success">
                                <i class="mdi mdi-chevron-right"></i>
                            </a>
                        </div>
                    @endif
                    <!-- End Pagination -->

                    @if (count($kegiatan) == 0)
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
    text: "Yakin ingin menghapus data Kegiatan?",
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
