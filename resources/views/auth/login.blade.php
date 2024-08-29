@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-4">
                <div class="card mt-5" style="background-color:black">
				    <form class="card" action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="card-body p-6">
                                <div class="card-title" style="text-align:center"><h3>LOGIN</h3></div>
                                <div class="form-group">
                                    <label class="form-label">Email</label>
									<input type="email" name="email" class="form-control {{ ($errors->has('email')) ? 'is-invalid' : '' }}" placeholder="Masukan email" value="{{ old('email') }}">
                                    @if($errors->has('email'))
                                        <small class="form-text invalid-feedback" style="display: block !important">{{ $errors->first('email') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control {{ ($errors->has('password')) ? 'is-invalid' : '' }}" id="exampleInputPassword1" placeholder="Password">
                                    @if($errors->has('password'))
                                            <small class="form-text invalid-feedback">{{ $errors->first('password') }}</small>
                                    @endif
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
                                </div>
                                <div class="alert alert-success m-3">
                                    Login untuk <b>Siswa</b> silahkan <a href="{{ url('login/siswa') }}" class="text-primary" style="text-decoration:none;">Klik Disini</a>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection
