@extends('auth.main')

@section('content')
<section class="login-content">
   <div class="row m-0 align-items-center vh-100" style="background-color: rgba(246, 248, 255, 0.964)">            
      <div class="col-md-12">
         <div class="row justify-content-center">
            <div class="col-md-4 shadow">
               <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                  <div class="card-body">
                     <a href="#" class="navbar-brand d-flex align-items-center mb-3">
                        <!--Logo start-->
                     </a>
                     <h2 class="mb-2 text-center">{{$title}}</h2>
                     <p class="text-center">Silahkan login dengan akun Anda.</p>
                     <form action="/login" method="POST">
                     @csrf
                     <div class="row">
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
                           @if (session('fail'))
                              <div class="col-lg-12">
                                 <div class="alert bg-danger text-white alert-dismissible">
                                       <span>
                                          <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9852 21.606C11.9852 21.606 19.6572 19.283 19.6572 12.879C19.6572 6.474 19.9352 5.974 19.3192 5.358C18.7042 4.742 12.9912 2.75 11.9852 2.75C10.9792 2.75 5.26616 4.742 4.65016 5.358C4.03516 5.974 4.31316 6.474 4.31316 12.879C4.31316 19.283 11.9852 21.606 11.9852 21.606Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M13.864 13.8249L10.106 10.0669" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M10.106 13.8249L13.864 10.0669" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                          {{ session('fail') }}
                                       </span>
                                 </div>
                              </div>
                           @endif
                     </div>
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label for="username" class="form-label">Username / Email</label>
                                 <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" autofocus>
                                 @error('nik')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label for="password" class="form-label">Password</label>
                                 <div class="form-group input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" aria-describedby="password">
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
                           </div>
                           <div class="col-lg-12 d-flex justify-content-end">
                              <a href="/lupa-password">Lupa Password?</a>
                           </div>
                        </div>
                        <div class="d-flex justify-content-center mt-5">
                           <button type="submit" class="btn btn-primary btn-sm">Login</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="sign-bg">
            <svg width="280" height="230" viewBox="0 0 431 398" fill="none" xmlns="http://www.w3.org/2000/svg">
               <g opacity="0.05">
               <rect x="-157.085" y="193.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -157.085 193.773)" fill="#3B8AFF"/>
               <rect x="7.46875" y="358.327" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 7.46875 358.327)" fill="#3B8AFF"/>
               <rect x="61.9355" y="138.545" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 61.9355 138.545)" fill="#3B8AFF"/>
               <rect x="62.3154" y="-190.173" width="543" height="77.5714" rx="38.7857" transform="rotate(45 62.3154 -190.173)" fill="#3B8AFF"/>
               </g>
            </svg>
         </div>
      </div>
   </div>
</section>
@endsection