@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{$subTitle}}</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="new-user-info">
                    <form action="@if($form === 'Tambah') /tambah-user @elseif($form === 'Edit') /edit-user/{{$detail->id_user}} @endif" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="user_code">Kode User</label>
                            <input type="text" class="form-control @error('user_code') is-invalid @enderror" id="user_code" name="user_code" value="@if($form === 'Tambah'){{ old('user_code') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->user_code}}@endif" @if($form === 'Detail') disabled @endif autofocus placeholder="Masukkan Kode" required>
                            @error('user_code')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="fullname">Nama Lengkap</label>
                            <input type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname" name="fullname" value="@if($form === 'Tambah'){{ old('fullname') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->fullname}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Nama Lengkap" required>
                            @error('fullname')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="user_address">Alamat</label>
                            <input type="text" class="form-control @error('user_address') is-invalid @enderror" id="user_address" name="user_address" value="@if($form === 'Tambah'){{ old('user_address') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->user_address}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Alamat">
                            @error('user_address')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="mobile_phone">Nomor Telepon</label>
                            <input type="text" class="form-control @error('mobile_phone') is-invalid @enderror" id="mobile_phone" name="mobile_phone" value="@if($form === 'Tambah'){{ old('mobile_phone') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->mobile_phone}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Nomor Telepon" oninput="handleNumberOnly(this)">
                            @error('mobile_phone')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="@if($form === 'Tambah'){{ old('email') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->email}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Email">
                            @error('email')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="@if($form === 'Tambah'){{ old('username') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->username}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Username">
                            @error('username')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="password">Password</label>
                            <div class="form-group input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" @if($form === 'Detail') disabled @endif placeholder="Masukkan Password">
                                <span class="input-group-text" style="cursor: pointer;" id="togglePassword">
                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1614 12.0531C15.1614 13.7991 13.7454 15.2141 11.9994 15.2141C10.2534 15.2141 8.83838 13.7991 8.83838 12.0531C8.83838 10.3061 10.2534 8.89111 11.9994 8.89111C13.7454 8.89111 15.1614 10.3061 15.1614 12.0531Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.998 19.355C15.806 19.355 19.289 16.617 21.25 12.053C19.289 7.48898 15.806 4.75098 11.998 4.75098H12.002C8.194 4.75098 4.711 7.48898 2.75 12.053C4.711 16.617 8.194 19.355 12.002 19.355H11.998Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                </span>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @if ($user->role === 'Administrator')
                            <div class="form-group col-md-6">
                                <label class="form-label" for="role">Role</label>
                                <select name="role" id="role" class="selectpicker form-control @error('role') is-invalid @enderror" data-live-search="true" @if($form === 'Detail') disabled @endif required>
                                    <option value="" selected disabled>-- Pilih --</option>
                                    <option value="Administrator" @if($form === "Tambah" && old("role") === "Administrator") selected @elseif($form === "Edit" && $detail->role === "Administrator") selected @endif)>Administrator</option>
                                    <option value="Admin Cabang" @if($form === "Tambah" && old("role") === "Admin Cabang") selected @elseif($form === "Edit" && $detail->role === "Admin Cabang") selected @endif)>Admin Cabang</option>
                                    <option value="Sales" @if($form === "Tambah" && old("role") === "Sales") selected @elseif($form === "Edit" && $detail->role === "Sales") selected @endif>Sales</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @else
                            <div class="form-group col-md-6">
                                <label class="form-label" for="role">Role</label>
                                <select name="role" id="role" class="selectpicker form-control @error('role') is-invalid @enderror" data-live-search="true" @if($form === 'Detail') disabled @endif required>
                                    <option value="" selected disabled>-- Pilih --</option>
                                    <option value="Sales" @if($form === "Tambah" && old("role") === "Sales") selected @elseif($form === "Edit" && $detail->role === "Sales") selected @endif>Sales</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                        <div class="form-group col-md-6">
                            <label class="form-label" for="photo">Foto</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="preview_image" name="photo" @if($form === 'Detail') disabled @endif>
                            @error('photo')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="photo"></label>
                            <div class="profile-img-edit position-relative">
                                <img src="@if($form === 'Tambah') {{ asset('photo/default1.jpg') }} @elseif($form === 'Edit' || $form === 'Detail') {{ asset('photo/'.$detail->photo) }} @endif" alt="profile-pic" id="load_image" class="theme-color-default-img profile-pic rounded avatar-100">
                            </div>
                        </div>
                    </div>
                    @include('components.tombolForm', ['linkKembali' => '/daftar-user'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection