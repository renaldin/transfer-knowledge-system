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
                <form action="@if($form == 'Tambah') /tambah-karyawan @elseif($form == 'Edit') /edit-karyawan/{{$detail->id}} @endif" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="role" class="form-label">Role <small class="text-danger">*</small></label>
                            <select name="role" id="role" class="form-control" @if($form == 'Detail') disabled @endif required>
                                <option value="" disabled selected>-- Pilih --</option>
                                <option value="Admin IT" @if($form == 'Edit' && $detail->user?->role == 'Admin IT') selected @elseif($form == 'Detail' && $detail->user?->role == 'Admin IT') selected @endif>Admin IT</option>
                                <option value="Admin Corporate" @if($form == 'Edit' && $detail->user?->role == 'Admin Corporate') selected @elseif($form == 'Detail' && $detail->user?->role == 'Admin Corporate') selected @endif>Admin Corporate</option>
                                <option value="Manager" @if($form == 'Edit' && $detail->user?->role == 'Manager') selected @elseif($form == 'Detail' && $detail->user?->role == 'Manager') selected @endif>Manager</option>
                                <option value="Karyawan Senior" @if($form == 'Edit' && $detail->user?->role == 'Karyawan Senior') selected @elseif($form == 'Detail' && $detail->user?->role == 'Karyawan Senior') selected @endif>Karyawan Senior</option>
                                <option value="Karyawan Junior" @if($form == 'Edit' && $detail->user?->role == 'Karyawan Junior') selected @elseif($form == 'Detail' && $detail->user?->role == 'Karyawan Junior') selected @endif>Karyawan Junior</option>
                            </select>
                            @error('role')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="full_name" class="form-label">Nama Lengkap <small class="text-danger">*</small></label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" id="full_name" @if($form == 'Tambah') value="{{old('full_name')}}" @elseif($form == 'Edit' || $form == 'Detail') value="{{$detail->full_name}}" @endif @if($form == 'Detail') disabled @endif placeholder="Masukkan Nama Lengkap..." required>
                            @error('full_name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email <small class="text-danger">*</small></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" @if($form == 'Tambah') value="{{old('email')}}" @elseif($form == 'Edit' || $form == 'Detail') value="{{$detail->user?->email}}" @endif @if($form == 'Detail') disabled @endif placeholder="Masukkan Email...">
                            @error('email')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="username" class="form-label">Username <small class="text-danger">*</small></label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" @if($form == 'Tambah') value="{{old('username')}}" @elseif($form == 'Edit' || $form == 'Detail') value="{{$detail->user?->username}}" @endif @if($form == 'Detail') disabled @endif placeholder="Masukkan Username...">
                            @error('username')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($form != 'Detail')
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password <small class="text-danger">*</small></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" @if($form == 'Detail') disabled @endif placeholder="Masukkan Password...">
                                @error('password')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                        <div class="mb-3 col-md-6">
                            <label for="photo" class="form-label">Foto <small class="text-danger">*</small></label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="preview_image" @if($form == 'Detail') disabled @endif>
                            @error('photo')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Alamat <small class="text-danger">*</small></label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" @if($form == 'Tambah') value="{{old('address')}}" @elseif($form == 'Edit' || $form == 'Detail') value="{{$detail->address}}" @endif @if($form == 'Detail') disabled @endif placeholder="Masukkan Alamat...">
                            @error('address')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="birth_date" class="form-label">Tanggal Lahir <small class="text-danger">*</small></label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" id="birth_date" @if($form == 'Tambah') value="{{old('birth_date')}}" @elseif($form == 'Edit' || $form == 'Detail') value="{{$detail->birth_date}}" @endif @if($form == 'Detail') disabled @endif placeholder="Masukkan Alamat...">
                            @error('birth_date')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="nik" class="form-label">NIK <small class="text-danger">*</small></label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik" @if($form == 'Tambah') value="{{old('nik')}}" @elseif($form == 'Edit' || $form == 'Detail') value="{{$detail->nik}}" @endif @if($form == 'Detail') disabled @endif placeholder="Masukkan NIK..." oninput="handleNumberOnly(this)">
                            @error('nik')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Organisasi <small class="text-danger">*</small></label>
                            <input type="text" class="form-control @error('organization') is-invalid @enderror" name="organization" id="organization" @if($form == 'Tambah') value="{{old('organization')}}" @elseif($form == 'Edit' || $form == 'Detail') value="{{$detail->organization}}" @endif @if($form == 'Detail') disabled @endif placeholder="Masukkan Organisasi...">
                            @error('organization')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="job_code" class="form-label">Kode Pekerjaan <small class="text-danger">*</small></label>
                            <input type="text" class="form-control @error('job_code') is-invalid @enderror" name="job_code" id="job_code" @if($form == 'Tambah') value="{{old('job_code')}}" @elseif($form == 'Edit' || $form == 'Detail') value="{{$detail->job_code}}" @endif @if($form == 'Detail') disabled @endif placeholder="Masukkan Kode Pekerjaan...">
                            @error('job_code')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="job_title" class="form-label">Pekerjaan <small class="text-danger">*</small></label>
                            <input type="text" class="form-control @error('job_title') is-invalid @enderror" name="job_title" id="job_title" @if($form == 'Tambah') value="{{old('job_title')}}" @elseif($form == 'Edit' || $form == 'Detail') value="{{$detail->job_title}}" @endif @if($form == 'Detail') disabled @endif placeholder="Masukkan Pekerjaan...">
                            @error('job_title')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($form == 'Detail')
                            <div class="mb-3 col-md-6">
                                <label for="photo" class="form-label"></label>
                                <img src="@if($form == 'Edit' || $form == 'Detail' && $detail->user?->photo) {{ asset('photo/'.$detail->user?->photo) }} @else {{ asset('photo/default.jpg') }} @endif" class="rounded-circle" alt="" style="width: 200px;" id="load_image">
                            </div>
                        @endif
                        <div class="col-md-12 text-center mt-4">
                            @if ($form == 'Detail')
                                <a href="/data-karyawan" class="btn btn-light">Kembali</a>
                            @else
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="/data-karyawan" class="btn btn-light">Kembali</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection