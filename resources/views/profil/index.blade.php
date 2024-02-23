@extends('layout.main')

@section('content')
<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

        <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <img src="{{ $user->photo ? asset('photo/'.$user->photo) : asset('photo/default.jpg') }}" alt="Profile" class="rounded-circle">
                <h2>{{$user->nama}}</h2>
                <h3>{{$user->role}}</h3>
            </div>
        </div>

        </div>

        <div class="col-xl-8">

        <div class="card">
            <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Data Profil</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profil</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ubah Password</button>
                    </li>
                </ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                        @if (Session('success') || Session('failed'))
                        <div class="row">
                            <div class="col-md-12">
                                @if (session('success'))
                                    <div class="alert alert-primary bg-primary text-light border-0 alert-dismissible" role="alert">
                                    {{session('success')}}
                                    </div>
                                @endif
                                @if (session('failed'))
                                    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible" role="alert">
                                    {{session('failed')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endif
                        <h5 class="card-title">Detail Profil</h5>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                            <div class="col-lg-9 col-md-8">{{$user->nama}}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Email</div>
                            <div class="col-lg-9 col-md-8">{{$user->email}}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Username</div>
                            <div class="col-lg-9 col-md-8">{{$user->username}}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Role</div>
                            <div class="col-lg-9 col-md-8">{{$user->role}}</div>
                        </div>
                    </div>
                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                    <!-- Profile Edit Form -->
                    <form action="/profil/{{$user->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{$user->name}}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{$user->email}}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" value="{{$user->username}}">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="photo" class="col-md-4 col-lg-3 col-form-label">Foto</label>
                            <div class="col-md-8 col-lg-9">
                                <input type="file" name="photo" id="photo" class="form-control">
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                    </div>

                    <div class="tab-pane fade pt-3" id="profile-change-password">
                        <form action="/ubah-password/{{$user->id}}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="password_lama" class="col-md-4 col-lg-3 col-form-label">Password Sekarang</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="password_lama" type="password" class="form-control @error('password_lama') is-invalid @enderror" id="password_lama">
                                    @error('password_lama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password_baru" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="password_baru" type="password" class="form-control @error('password_lama') is-invalid @enderror" id="password_baru">
                                    @error('password_baru')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
</section>
@endsection