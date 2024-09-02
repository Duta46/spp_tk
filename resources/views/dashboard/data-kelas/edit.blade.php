@extends('layouts.dashboard')

@section('title', 'Edit Kelas')

@section('breadcrumb')
	<li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item">Kelas</li>
     <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<div class="row">
         <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                       <div class="card-title">{{ __('Edit Kelas') }}</div>

                        <form method="post" action="{{ url('/dashboard/data-kelas', $edit->id) }}">

                           @csrf
                           @method('put')

                           <div class="form-group">
                              <label>Nama Kelas</label>
                              <input type="text" class="form-control @error('kelas') is-invalid @enderror" name="kelas" value="{{ $edit->nama_kelas }}">
                              <span class="text-danger">@error('kelas') {{ $message }} @enderror</span>
                           </div>

                           <a href="{{ url('dashboard/data-kelas') }}" class="btn btn-primary btn-rounded">
                              <i class="mdi mdi-chevron-left"></i> Kembali
                           </a>
                           <button type="submit" class="btn btn-success btn-rounded">
                                 <i class="mdi mdi-check"></i> Simpan
                           </button>

                        </form>
                  </div>
              </div>
            </div>
	</div>

@endsection

@section('sweet')

function deleteData(id){
      Swal.fire({
               title: 'PERINGATAN!',
               text: "Yakin ingin menghapus data kelas?",
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

@endsection
