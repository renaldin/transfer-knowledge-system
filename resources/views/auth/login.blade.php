@extends('auth.main')

@section('content')
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

         <div class="d-flex justify-content-center py-4">
           <a href="index.html" class="logo d-flex align-items-center w-auto">
             <img src="{{ asset('template/assets/img/logo.png') }}" alt="">
             <span class="d-none d-lg-block">SISTEM</span>
           </a>
         </div><!-- End Logo -->

         <div class="card mb-3">
           <div class="card-body">
             <div class="pt-4 pb-2">
               <h5 class="card-title text-center pb-0 fs-4">{{$subTitle}}</h5>
               <p class="text-center small">Silahkan Login!</p>
             </div>
             @if (session('success') || session('failed'))
               <div class="row my-2">
                  <div class="col-12">
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

             <form method="POST" action="/login" class="row g-3">
               @csrf
               <div class="col-12">
                  <label for="username" class="form-label">Username / Email</label>
                  <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" value="{{old('username')}}">
                  @error('username')
                     <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
               </div>
               <div class="col-12">
                 <label for="password" class="form-label">Password</label>
                 <div class="input-group has-validation">
                     <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                     <span class="input-group-text" id="togglePassword" style="cursor: pointer;"><i class="bi bi-eye-slash" id="iconPassword"></i></span>
                     @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                 </div>
               </div>
               <div class="col-12">
                 <button class="btn btn-primary w-100" type="submit">Login</button>
               </div>
               <div class="col-12">
                 <p class="small mb-0">Belum punya akun? <a href="/register">Register</a></p>
               </div>
             </form>
           </div>
         </div>

         <div class="credits">
           Designed by <a href="https://bootstrapmade.com/">Sistem</a>
         </div>

       </div>
     </div>
   </div>
</section>
@endsection