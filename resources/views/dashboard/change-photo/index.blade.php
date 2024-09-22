@extends('layouts.dashboard')

@section('title', 'Foto Profil')

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Foto Profil</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">{{ __('Ubah Foto Profile') }}</div>
                <form action="{{ route('profile.updatePhoto') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="profile_photo">Foto Profile</label>
                        <input type="file" name="profile_photo" id="profile_photo" class="form-control" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
