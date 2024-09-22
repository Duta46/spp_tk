@extends('layouts.dashboard')

@section('title', 'Data Ujian')

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Ujian</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">{{ __('Tambah Ujian') }}</div>

                    <form method="post" action="{{ url('/dashboard/data-ujian') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">
                                    Jenis Ujian
                                </label>
                            </div>
                            <select class="custom-select @error('jenis_ujian') is-invalid @enderror" name="jenis_ujian">

                                <option value="" hidden>Silahkan Pilih</option>
                                <option value="PTS">PTS</option>
                                <option value="PAS">PAS</option>
                            </select>
                        </div>
                        <span class="text-danger">
                            @error('jenis_ujian')
                                {{ $message }}
                            @enderror
                        </span>

                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="text" class="form-control @error('tahun') is-invalid @enderror" name="tahun"
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
                                    Semester
                                </label>
                            </div>
                            <select class="custom-select @error('semester') is-invalid @enderror" name="semester">

                                <option value="" hidden>Silahkan Pilih</option>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>
                        <span class="text-danger">
                            @error('semester')
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
                    <div class="card-title">Data Ujian</div>

                    <div class="table-responsive mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">JENIS UJIAN</th>
                                    <th scope="col">TAHUN</th>
                                    <th scope="col">SEMESTER</th>
                                    <th scope="col">NOMINAL</th>
                                    <th scope="col">DIBUAT</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($ujian as $value)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $value->jenis_ujian }}</td>
                                        <td>{{ $value->tahun }}</td>
                                        <td>{{ $value->semester }}</td>
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
                                                        href="{{ url('dashboard/data-ujian/' . $value->id . '/edit') }}"><i
                                                            class="ti-pencil"></i> Edit </a>
                                                    <form method="post"
                                                        action="{{ url('dashboard/data-ujian', $value->id) }}"
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
                    @if ($ujian->lastPage() != 1)
                        <div class="btn-group float-right">
                            <a href="{{ $ujian->previousPageUrl() }}" class="btn btn-success">
                                <i class="mdi mdi-chevron-left"></i>
                            </a>
                            @for ($i = 1; $i <= $ujian->lastPage(); $i++)
                                <a class="btn btn-success {{ $i == $ujian->currentPage() ? 'active' : '' }}"
                                    href="{{ $ujian->url($i) }}">{{ $i }}</a>
                            @endfor
                            <a href="{{ $ujian->nextPageUrl() }}" class="btn btn-success">
                                <i class="mdi mdi-chevron-right"></i>
                            </a>
                        </div>
                    @endif
                    <!-- End Pagination -->

                    @if (count($ujian) == 0)
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
    text: "Yakin ingin menghapus data Ujian?",
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
