@extends('layout.main')

@section('content')
<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

        <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <img src="{{ $user->foto ? asset('foto/'.$user->foto) : asset('foto/default.jpg') }}" alt="Profile" class="rounded-circle">
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
                        <label for="nama" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{$user->nama}}">
                            @error('nama')
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
                        <label for="foto" class="col-md-4 col-lg-3 col-form-label">Foto</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="file" name="foto" id="foto" class="form-control">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                <!-- Settings Form -->
                <form>

                    <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                    <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="changesMade" checked>
                        <label class="form-check-label" for="changesMade">
                            Changes made to your account
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="newProducts" checked>
                        <label class="form-check-label" for="newProducts">
                            Information on new products and services
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="proOffers">
                        <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                        <label class="form-check-label" for="securityNotify">
                            Security alerts
                        </label>
                        </div>
                    </div>
                    </div>

                    <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form>

                    <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                    </div>
                    </div>

                    <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                    </div>
                    </div>

                    <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                    </div>
                    </div>

                    <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                </form><!-- End Change Password Form -->

                </div>

            </div><!-- End Bordered Tabs -->

            </div>
        </div>

        </div>
    </div>
</section>
@endsection