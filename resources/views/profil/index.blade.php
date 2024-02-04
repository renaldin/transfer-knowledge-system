@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-xl-6 col-lg-6">
        <div class="card">
            <div class="card-body">
               <div class="d-flex flex-wrap align-items-center justify-content-between">
                  <div class="d-flex flex-wrap align-items-center">
                     <div class="profile-img position-relative me-3 mb-3 mb-lg-0 profile-logo profile-logo1">
                        <img src="@if($user->photo == null){{ asset('photo/default1.jpg') }}@else{{ asset('photo/'.$user->photo) }}@endif" alt="User-Profile" class="theme-color-default-img img-fluid rounded-pill avatar-100">
                     </div>
                     <div class="d-flex flex-wrap align-items-center mb-3 mb-sm-0">
                        <h4 class="me-2 h4">{{$user->fullname}}</h4>
                        <span> - {{$user->role}}</span>
                     </div>
                  </div>
               </div>
            </div>
        </div>
         <div class="card">
            <div class="card-header">
               <div class="header-title">
                  <h4 class="card-title">Tentang Anda</h4>
               </div>
            </div>
            <div class="card-body">
               <div class="user-bio">
                <p>Jika ingin merubah data profil Anda, silahkan ubah di form edit profil.</p>
               </div>
               <div class="mt-2">
                <h6 class="mb-1">Nama Lengkap:</h6>
                <p>{{$user->fullname}}</p>
               </div>
               <div class="mt-2">
                <h6 class="mb-1">Alamat:</h6>
                <p>{{$user->user_address}}</p>
               </div>
               <div class="mt-2">
                <h6 class="mb-1">Nomor Telepon:</h6>
                <p>{{$user->mobile_phone}}</p>
               </div>
               <div class="mt-2">
                <h6 class="mb-1">Email</h6>
                <p>{{$user->email}}</p>
               </div>
               <div class="mt-2">
                <h6 class="mb-1">Username</h6>
                <p>{{$user->username}}</p>
               </div>
               <div class="mt-2">
                <h6 class="mb-1">Role</h6>
                <p>{{$user->role}}</p>
               </div>
            </div>
         </div>
    </div>
    <div class="col-xl-6 col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{$subTitle}}</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="new-user-info">
                    @if (session('success'))
                        <div class="col-lg-12">
                            <div class="alert bg-primary text-white alert-dismissible">
                                <span>
                                    <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9846 21.606C11.9846 21.606 19.6566 19.283 19.6566 12.879C19.6566 6.474 19.9346 5.974 19.3196 5.358C18.7036 4.742 12.9906 2.75 11.9846 2.75C10.9786 2.75 5.26557 4.742 4.65057 5.358C4.03457 5.974 4.31257 6.474 4.31257 12.879C4.31257 19.283 11.9846 21.606 11.9846 21.606Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M9.38574 11.8746L11.2777 13.7696L15.1757 9.86963" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>                            
                                    {{ session('success') }}
                                </span>
                            </div>
                        </div>
                    @endif
                    @if (session('failed'))
                        <div class="col-lg-12">
                            <div class="alert bg-danger text-white alert-dismissible">
                                <span>
                                    <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9852 21.606C11.9852 21.606 19.6572 19.283 19.6572 12.879C19.6572 6.474 19.9352 5.974 19.3192 5.358C18.7042 4.742 12.9912 2.75 11.9852 2.75C10.9792 2.75 5.26616 4.742 4.65016 5.358C4.03516 5.974 4.31316 6.474 4.31316 12.879C4.31316 19.283 11.9852 21.606 11.9852 21.606Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M13.864 13.8249L10.106 10.0669" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M10.106 13.8249L13.864 10.0669" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                    {{ session('failed') }}
                                </span>
                            </div>
                        </div>
                    @endif
                    <form action="/edit-profil/{{$user->id_user}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="fullname">Nama Lengkap</label>
                            <input type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname" name="fullname" value="{{$user->fullname}}" autofocus placeholder="Masukkan Nama Lengkap" required>
                            @error('fullname')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="user_address">Alamat</label>
                            <input type="text" class="form-control @error('user_address') is-invalid @enderror" id="user_address" name="user_address" value="{{$user->user_address}}" placeholder="Masukkan Alamat">
                            @error('user_address')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="mobile_phone">Nomor Telepon</label>
                            <input type="text" class="form-control @error('mobile_phone') is-invalid @enderror" id="mobile_phone" name="mobile_phone" value="{{$user->mobile_phone}}" placeholder="Masukkan Nomor Telepon" oninput="handleNumberOnly(this)">
                            @error('mobile_phone')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{$user->email}}" placeholder="Masukkan Email">
                            @error('email')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{$user->username}}" placeholder="Masukkan Username">
                            @error('username')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label" for="photo">Foto</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="preview_image" name="photo">
                            @error('photo')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="photo"></label>
                            <div class="profile-img-edit position-relative">
                                <img src="@if($user->photo === null) {{ asset('photo/default1.jpg') }} @else {{ asset('photo/'.$user->photo) }} @endif" alt="profile-pic" id="load_image" class="theme-color-default-img profile-pic rounded avatar-100">
                            </div>
                        </div>
                    </div>
                    <br>
                    <center>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection