@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">{{$subTitle}}</h5>
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
                <form action="/profil/{{$user->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap <small class="text-danger">*</small></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$user->name}}" placeholder="Masukkan Nama Lengkap...">
                        @error('name')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <small class="text-danger">*</small></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{$user->email}}" placeholder="Masukkan Email...">
                        @error('email')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username <small class="text-danger">*</small></label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{$user->username}}" placeholder="Masukkan Username...">
                        @error('username')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto <small class="text-danger">*</small></label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="photo">
                        @error('photo')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">{{$title}}</h5>
                <table>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td class="text-center" style="width: 25px;">:</td>
                        <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td class="text-center" style="width: 25px;">:</td>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td class="text-center" style="width: 25px;">:</td>
                        <td>{{$user->username}}</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td class="text-center" style="width: 25px;">:</td>
                        <td>{{$user->role}}</td>
                    </tr>
                    <tr style="vertical-align: top;">
                        <th>Foto</th>
                        <td class="text-center" style="width: 25px;">:</td>
                        <td>
                            <img src="{{ $user->photo ? asset("photo/".$user->photo) : asset("photo/default.jpg") }}" class="rounded-circle" alt="" style="width: 200px;">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection