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
                <form action="/ubah-password/{{$user->id}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="old_password" class="form-label">Password Lama <small class="text-danger">*</small></label>
                        <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" id="old_password" placeholder="Masukkan Password Lama..." required>
                        @error('old_password')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Password Baru <small class="text-danger">*</small></label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password" placeholder="Masukkan Password Baru...">
                        @error('new_password')
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
</div>
@endsection