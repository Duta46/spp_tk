@extends('layouts.app')

@section('content')
@include('sweetalert::alert')

<div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-4">
                <div class="card mt-5" style="background-color:black">
				    <form class="card" action="{{ url('login/siswa/proses') }}" method="post">
                            @csrf
                            <div class="card-body p-6">
                                <div class="card-title" style="text-align:center"><h3>LOGIN</h3></div>
                                <div class="form-group">
                                    <label class="form-label">NISN</label>
									<input type="text" name="nisn" class="form-control {{ ($errors->has('nisn')) ? 'is-invalid' : '' }}" placeholder="Masukan NISN" value="{{ old('nisn') }}">
                                    @if($errors->has('email'))
                                        <small class="form-text invalid-feedback" style="display: block !important">{{ $errors->first('nisn') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nama Siswa</label>
                                    <input type="text" name="nama_siswa" class="form-control {{ ($errors->has('nama_siswa')) ? 'is-invalid' : '' }}" placeholder="Nama Siswa">
                                    @if($errors->has('nama_siswa'))
                                            <small class="form-text invalid-feedback">{{ $errors->first('nama_siswa') }}</small>
                                    @endif
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
                                </div>
                                <div class="alert alert-success m-3">
                                Login untuk <b>Petugas</b> silahkan <a href="{{ url('login') }}" class="text-primary" style="text-decoration:none;">Klik Disini</a>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection