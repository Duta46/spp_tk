@extends('layouts.dashboard')

@section('title', 'Edit Ujian')

@section('breadcrumb')
	<li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item">Ujian</li>
     <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
   <div class="row">
         <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                       <div class="card-title">{{ __('Edit Ujian') }}</div>

                        <form method="post" action="{{ url('/dashboard/data-ujian', $edit->id) }}">
                           @csrf
                           @method('put')

                           <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">
                                    Jenis Ujian
                                </label>
                            </div>
                            <select class="custom-select @error('jenis_ujian') is-invalid @enderror" name="jenis_ujian">
                                <option value="">Silahkan Pilih</option>
                                <option value="PTS" {{ $edit->jenis_ujian == 'PTS' ? 'selected' : '' }}>PTS
                                </option>
                                <option value="PAS" {{ $edit->jenis_ujian == 'PAS' ? 'selected' : '' }}>PAS
                                </option>
                            </select>
                        </div>
                        <span class="text-danger">
                            @error('jenis_ujian')
                                {{ $message }}
                            @enderror
                        </span>

                           <div class="form-group">
                              <label>Tahun</label>
                              <input type="text" class="form-control @error('tahun') is-invalid @enderror" name="tahun" value="{{ $edit->tahun }}">
                              <span class="text-danger">@error('tahun') {{ $message }} @enderror</span>
                           </div>

                           <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">
                                    Semester
                                </label>
                            </div>
                            <select class="custom-select @error('semester') is-invalid @enderror" name="semester">
                                <option value="">Silahkan Pilih</option>
                                <option value="Ganjil" {{ $edit->semester == 'Ganjil' ? 'selected' : '' }}>Ganjil
                                </option>
                                <option value="Genap" {{ $edit->semester == 'Genap' ? 'selected' : '' }}>Genap
                                </option>
                            </select>
                        </div>
                        <span class="text-danger">
                            @error('semester')
                                {{ $message }}
                            @enderror
                        </span>

                           <div class="form-group">
                              <label>Nominal</label>
                              <input type="number" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="{{ $edit->nominal }}">
                              <span class="text-danger">@error('nominal') {{ $message }} @enderror</span>
                           </div>

                           <a href="{{ url('dashboard/data-ujian') }}" class="btn btn-primary btn-rounded">
                              <i class="mdi mdi-chevron-left"></i> Kembali
                           </a>

                           <button type="submit" class="btn btn-success btn-rounded  float-right">
                                 <i class="mdi mdi-check"></i> Simpan
                           </button>
                        </form>
                  </div>
              </div>
            </div>

	</div>
@endsection
