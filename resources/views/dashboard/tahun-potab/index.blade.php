@extends('layouts.dashboard')

@section('title', 'Data Tahun Potab')

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Tahun Potab</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">{{ __('Tambah Tahun Potab') }}</div>

                    <form method="post" action="{{ url('/dashboard/tahun-potab') }}">
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
                    <div class="card-title">Data Tahun Potab</div>

                    <div class="table-responsive mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">TAHUN</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($tahunpotab as $value)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $value->tahun }}</td>
                                        <td>
                                            <div class="hide-menu">
                                                <a href="javascript:void(0)" class="text-dark" id="actiondd" role="button"
                                                    data-toggle="dropdown">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="actiondd">
                                                    <a class="dropdown-item"
                                                        href="{{ url('/dashboard/tahun-potab/' . $value->id . '/edit') }}"><i
                                                            class="ti-pencil"></i> Edit </a>
                                                    <form method="post"
                                                        action="{{ url('/dashboard/tahun-potab', $value->id) }}"
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
                    @if ($tahunpotab->lastPage() != 1)
                        <div class="btn-group float-right">
                            <a href="{{ $app->previousPageUrl() }}" class="btn btn-success">
                                <i class="mdi mdi-chevron-left"></i>
                            </a>
                            @for ($i = 1; $i <= $tahunpotab->lastPage(); $i++)
                                <a class="btn btn-success {{ $i == $tahunpotab->currentPage() ? 'active' : '' }}"
                                    href="{{ $tahunpotab->url($i) }}">{{ $i }}</a>
                            @endfor
                            <a href="{{ $tahunpotab->nextPageUrl() }}" class="btn btn-success">
                                <i class="mdi mdi-chevron-right"></i>
                            </a>
                        </div>
                    @endif
                    <!-- End Pagination -->

                    @if (count($tahunpotab) == 0)
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
    text: "Yakin ingin menghapus data Tahun Potab?",
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
