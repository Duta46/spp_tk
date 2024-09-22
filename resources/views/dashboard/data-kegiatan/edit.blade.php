@extends('layouts.dashboard')

@section('title', 'Edit Kegiatan')

@section('breadcrumb')
	<li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item">Kegiatan</li>
     <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
   <div class="row">
         <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                       <div class="card-title">{{ __('Edit Kegiatan') }}</div>

                        <form method="post" action="{{ url('/dashboard/data-kegiatan', $edit->id) }}">
                           @csrf
                           @method('put')

                           <div class="form-group">
                              <label>Nominal</label>
                              <input type="number" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="{{ $edit->nominal }}">
                              <span class="text-danger">@error('nominal') {{ $message }} @enderror</span>
                           </div>

                           <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="5" name="keterangan">{{ $edit->keterangan }}</textarea>
                            <span class="text-danger">
                                @error('keterangan')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                           <a href="{{ url('dashboard/data-kegiatan') }}" class="btn btn-primary btn-rounded">
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
