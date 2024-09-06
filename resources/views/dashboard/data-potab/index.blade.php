@extends('layouts.dashboard')

@section('title', 'Data Potab')

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Data Potab</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Data Potab</div>
                    <a href="{{ url('/dashboard/potab/create') }}" class="btn btn-success btn-rounded float-right mb-3">
                        <i class="mdi mdi-plus-circle"></i> {{ __('Tambah Data Potab') }}
                    </a>
                    <div class="table-responsive mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">TAHUN</th>
                                    <th scope="col">BULAN</th>
                                    <th scope="col">NOMINAL</th>
                                    <th scope="col">DIBUAT</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($potab as $value)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $value->tahunBekal->tahun }}</td>
                                        <td>{{ $value->bulan }}</td>
                                        <td>{{ $value->nominal }}</td>
                                        <td>{{ $value->created_at->format('d M, Y') }}</td>

                                        <td>
                                            <div class="hide-menu">
                                                <a href="javascript:void(0)" class="text-dark" id="actiondd" role="button"
                                                    data-toggle="dropdown">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="actiondd">
                                                    <a class="dropdown-item"
                                                        href="{{ url('dashboard/bekal/' . $value->id . '/edit') }}"><i
                                                            class="ti-pencil"></i> Edit </a>
                                                    <form method="post" action="{{ url('dashboard/bekal', $value->id) }}"
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
                    @if ($potab->lastPage() != 1)
                        <div class="btn-group float-right">
                            <a href="{{ $potab->previousPageUrl() }}" class="btn btn-success">
                                <i class="mdi mdi-chevron-left"></i>
                            </a>
                            @for ($i = 1; $i <= $potab->lastPage(); $i++)
                                <a class="btn btn-success {{ $i == $potab->currentPage() ? 'active' : '' }}"
                                    href="{{ $potab->url($i) }}">{{ $i }}</a>
                            @endfor
                            <a href="{{ $potab->nextPageUrl() }}" class="btn btn-success">
                                <i class="mdi mdi-chevron-right"></i>
                            </a>
                        </div>
                    @endif
                    <!-- End Pagination -->

                    @if (count($bekal) == 0)
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
    text: "Yakin ingin menghapus data Potab?",
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
