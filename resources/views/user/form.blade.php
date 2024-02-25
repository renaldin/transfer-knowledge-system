@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">{{$subTitle}}</div>
            </div>
            <div class="card-body">
                @if (Session('success'))
                    <div class="alert bg-primary text-white" role="alert">
                        {{Session('success')}}
                    </div>
                @endif
                @if (Session('failed'))
                    <div class="alert bg-danger text-white" role="alert">
                        {{Session('failed')}}
                    </div>
                @endif
                <form action="@if($form == 'Tambah') /tambah-pengguna @elseif($form == 'Edit') /edit-pengguna/{{$detail->id}} @endif" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="role" class="form-label">Role <small class="text-danger">*</small></label>
                            <select name="role" id="role" class="form-control" @if($form == 'Detail') disabled @endif required>
                                <option value="" disabled selected>-- Pilih --</option>
                                <option value="Admin IT" @if($form == 'Edit' && $detail->role == 'Admin IT') selected @elseif($form == 'Detail' && $detail->role == 'Admin IT') selected @endif>Admin IT</option>
                                <option value="Admin Corporate" @if($form == 'Edit' && $detail->role == 'Admin Corporate') selected @elseif($form == 'Detail' && $detail->role == 'Admin Corporate') selected @endif>Admin Corporate</option>
                                <option value="Manager" @if($form == 'Edit' && $detail->role == 'Manager') selected @elseif($form == 'Detail' && $detail->role == 'Manager') selected @endif>Manager</option>
                                <option value="Karyawan Senior" @if($form == 'Edit' && $detail->role == 'Karyawan Senior') selected @elseif($form == 'Detail' && $detail->role == 'Karyawan Senior') selected @endif>Karyawan Senior</option>
                                <option value="Karyawan Junior" @if($form == 'Edit' && $detail->role == 'Karyawan Junior') selected @elseif($form == 'Detail' && $detail->role == 'Karyawan Junior') selected @endif>Karyawan Junior</option>
                            </select>
                            @error('role')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Nama Lengkap <small class="text-danger">*</small></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" @if($form == 'Tambah') value="{{old('name')}}" @elseif($form == 'Edit' || $form == 'Detail') value="{{$detail->name}}" @endif @if($form == 'Detail') disabled @endif placeholder="Masukkan Nama Lengkap...">
                            @error('name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email <small class="text-danger">*</small></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" @if($form == 'Tambah') value="{{old('email')}}" @elseif($form == 'Edit' || $form == 'Detail') value="{{$detail->email}}" @endif @if($form == 'Detail') disabled @endif placeholder="Masukkan Email...">
                            @error('email')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="username" class="form-label">Username <small class="text-danger">*</small></label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" @if($form == 'Tambah') value="{{old('username')}}" @elseif($form == 'Edit' || $form == 'Detail') value="{{$detail->username}}" @endif @if($form == 'Detail') disabled @endif placeholder="Masukkan Username...">
                            @error('username')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">Password <small class="text-danger">*</small></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" @if($form == 'Detail') disabled @endif placeholder="Masukkan Password...">
                            @error('password')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="photo" class="form-label">Foto <small class="text-danger">*</small></label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="preview_image" @if($form == 'Detail') disabled @endif>
                            @error('photo')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="photo" class="form-label"></label>
                            <img src="@if($form == 'Edit' || $form == 'Detail' && $detail->photo) {{ asset('photo/'.$detail->photo) }} @else {{ asset('photo/default.jpg') }} @endif" class="rounded-circle" alt="" style="width: 200px;" id="load_image">
                        </div>
                        <div class="col-md-12 text-center mt-4">
                            @if ($form == 'Detail')
                                <a href="/data-pengguna" class="btn btn-light">Kembali</a>
                            @else
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="/data-pengguna" class="btn btn-light">Kembali</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection