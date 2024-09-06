@extends('layouts.dashboard')

@section('title', 'Edit Tahun Bekal')

@section('breadcrumb')
	<li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item">Tahun Bekal</li>
     <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
   <div class="row">
         <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                       <div class="card-title">{{ __('Edit Tahun Bekal') }}</div>

                        <form method="post" action="{{ url('/dashboard/tahun-bekal', $edit->id) }}">
                           @csrf
                           @method('put')

                           <div class="form-group">
                              <label>Tahun</label>
                              <input type="number" class="form-control @error('tahun') is-invalid @enderror" name="tahun" value="{{ $edit->tahun }}">
                              <span class="text-danger">@error('tahun') {{ $message }} @enderror</span>
                           </div>

                           <a href="{{ url('/dashboard/tahun-bekal') }}" class="btn btn-primary btn-rounded">
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
