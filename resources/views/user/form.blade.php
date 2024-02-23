@extends('layout.main')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-3">
            <div class="card-header">
                <h3 class="card-title">{{$subTitle}}</h3>
            </div>
            <div class="card-body">
                <form class="row g-3" action="@if($form == 'Tambah') /tambah-pengguna @elseif($form == 'Edit') /edit-pengguna/{{$detail->id}} @endif" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" name="role" id="role" @if($form == 'Detail') disabled @endif required>
                        <option value="" selected disabled>-- Pilih --</option>
                        <option value="Pelamar" @if($form == 'Edit' && $detail->role == 'Pelamar') selected @elseif($form == 'Detail' && $detail->role == 'Pelamar') selected @endif>Pelamar</option>
                        <option value="HRD" @if($form == 'Edit' && $detail->role == 'HRD') selected @elseif($form == 'Detail' && $detail->role == 'HRD') selected @endif>HRD</option>
                        <option value="Manager" @if($form == 'Edit' && $detail->role == 'Manager') selected @elseif($form == 'Detail' && $detail->role == 'Pelamar') selected @endif>Manager</option>
                    </select>
                    <div class="text-danger">
                        @error('role')
                        {{ $message}}
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Lengkap..." @if($form == 'Tambah')value="{{old('name')}}"@elseif($form == 'Edit' || $form == 'Detail')value="{{$detail->name}}"@endif @if($form == 'Detail') disabled @endif>
                    <div class="text-danger">
                        @error('name')
                        {{ $message}}
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email..." @if($form == 'Tambah')value="{{old('email')}}"@elseif($form == 'Edit' || $form == 'Detail')value="{{$detail->email}}"@endif @if($form == 'Detail') disabled @endif>
                    <div class="text-danger">
                        @error('email')
                        {{ $message}}
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="username" class="form-label">Usermame</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username..." @if($form == 'Tambah')value="{{old('username')}}"@elseif($form == 'Edit' || $form == 'Detail')value="{{$detail->username}}"@endif @if($form == 'Detail') disabled @endif required>
                    <div class="text-danger">
                    @error('username')
                        {{ $message}}
                    @enderror 
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password..." @if($form == 'Detail') disabled @endif>
                    <div class="text-danger">
                    @error('password')
                        {{ $message}}
                    @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="photo" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="preview_image" name="photo" @if($form == 'Detail') disabled @endif>
                    <div class="text-danger">
                    @error('photo')
                        {{ $message}}
                    @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label"></label>
                    <img src="{{ $form == 'Edit' || $form == 'Detail' && $detail->photo ? asset('photo/'.$detail->photo) : asset('photo/default.jpg') }}" alt="Profile" class="rounded-circle" id="load_image" style="width: 160px; height: 160px;">
                </div>
                @include('components.buttonForm')
                </form>
            </div>
            </div>
        </div>
    </div>
</section>
@endsection