@extends('auth.main')

@section('content')
<p class="text-center">Silahkan Login.</p>
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
<form action="/login" method="POST">
  @csrf
  <div class="mb-3">
    <label for="username" class="form-label">Username / Email</label>
    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" aria-describedby="emailHelp">
    @error('username')
      <div class="form-text text-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-4">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="exampleInputPassword1">
    @error('username')
      <div class="form-text text-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="d-flex align-items-center justify-content-end mb-4">
    <a class="text-primary fw-bold" href="">Forgot Password ?</a>
  </div>
  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Login</button>
</form>
@endsection