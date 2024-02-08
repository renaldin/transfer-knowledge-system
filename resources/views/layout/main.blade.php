<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Monitoring Project | {{ $subTitle }}</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('template/html/assets/images/favicon.ico') }}" />
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>

    <!-- select2 -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    {{-- <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link rel="stylesheet" href="{{ asset('template/html/assets/vendor/bootstrap-select/css/bootstrap-select.min.css') }}" /> --}}
    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="{{ asset('template/html/assets/css/core/libs.min.css') }}" />

    <!-- Aos Animation Css -->
    <link rel="stylesheet" href="{{ asset('template/html/assets/vendor/aos/dist/aos.css') }}" />

    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="{{ asset('template/html/assets/css/hope-ui.min.css?v=1.2.0') }}" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('template/html/assets/css/custom.min.css?v=1.2.0') }}" />

    <!-- Dark Css -->
    <link rel="stylesheet" href="{{ asset('template/html/assets/css/dark.min.css') }}" />

    <!-- Customizer Css -->
    <link rel="stylesheet" href="{{ asset('template/html/assets/css/customizer.min.css') }}" />

    <!-- RTL Css -->
    <link rel="stylesheet" href="{{ asset('template/html/assets/css/rtl.min.css') }}" />
   <style>
    body {
    font-family: 'Open Sans', sans-serif;
}

   </style>
   {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"> --}}
    
</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->

    {{-- sidebar --}}
    @include('layout.sidebar')

    <main class="main-content">
        <div class="position-relative iq-banner">
            <!--Nav Start-->
            <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
                <div class="container-fluid navbar-inner">
                    <a href="#" class="navbar-brand">
                        <!--Logo start-->
                        <!--logo End-->
                        <h4 class="logo-title">Sistem Project</h4>
                    </a>
                    <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                        <i class="icon">
                            <svg width="20px" height="20px" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                            </svg>
                        </i>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <span class="mt-2 navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="@if ($user->photo === null) {{ asset('photo/default1.jpg') }} @else {{ asset('photo/' . $user->photo) }} @endif"
                                        alt="User-Profile"
                                        class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                                    <div class="caption ms-3 d-none d-md-block ">
                                        <h6 class="mb-0 caption-title">{{ $user->fullname }}</h6>
                                        <p class="mb-0 caption-sub-title">{{ $user->role }}</p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a href="/profil" class="dropdown-item" href="#">Profil</a>
                                    </li>
                                    <li>
                                        <a href="/ubah-password" class="dropdown-item" href="#">Ubah Password</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#logout">Logout</button></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav> <!-- Nav Header Component Start -->
            {{-- <div class="iq-navbar-header" style="height: 100px;">
                <div class="container-fluid iq-container">
                </div>
            </div> --}}
        </div>
        <div class="conatiner-fluid content-inner mt-n5 py-0">
            <div class="row" style="margin-top: 80px;">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="flex-wrap d-flex justify-content-between align-items-center mb-4">
                                        <div class="text-black">
                                            @if ($subTitle === 'Dashboard')
                                                <h3>Hello, {{ $user->fullname }}
                                                </h3>
                                                <p>Selamat Datang Di Website Sistem Monitoring Project.</p>
                                            @else
                                                <h3>{{ $subTitle }}</h3>
                                            @endif
                                        </div>
                                        <div class="text-black">
                                            <span class="btn btn-link btn-outline-primary" style="cursor: auto; text-decoration: none;">
                                                @if ($title === null)
                                                    {{ $subTitle }}
                                                @else
                                                    {{ $title }} / {{ $subTitle }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- content --}}
            @yield('content')

        </div>
        <!-- Footer Section Start -->
        <footer class="footer">
            <div class="footer-body">
                <ul class="left-panel list-inline mb-0 p-0">
                    {{-- <li class="list-inline-item"><a href="#">Sistem Monitoring Project</a></li> --}}
                </ul>
                <div class="right-panel">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script> Designed Sistem Monitoring Project
                </div>
            </div>
        </footer>

        <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin akan logout ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <a href="/logout" type="button" class="btn btn-danger btn-sm">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

        <!-- Select2 -->
        
        {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
        {{-- <script src="{{ asset('template/html/assets/vendor/bootstrap-select/js/bootstrap-select.min.js') }}" defer></script> --}}

        <!-- Library Bundle Script -->
        <script src="{{ asset('template/html/assets/js/core/libs.min.js') }}"></script>

        <!-- External Library Bundle Script -->
        <script src="{{ asset('template/html/assets/js/core/external.min.js') }}"></script>

        <!-- Widgetchart Script -->
        <script src="{{ asset('template/html/assets/js/charts/widgetcharts.js') }}"></script>

        <!-- mapchart Script -->
        <script src="{{ asset('template/html/assets/js/charts/vectore-chart.js') }}"></script>
        <script src="{{ asset('template/html/assets/js/charts/dashboard.js') }}"></script>

        <!-- fslightbox Script -->
        <script src="{{ asset('template/html/assets/js/plugins/fslightbox.js') }}"></script>

        <!-- Settings Script -->
        <script src="{{ asset('template/html/assets/js/plugins/setting.js') }}"></script>

        <!-- Slider-tab Script -->
        <script src="{{ asset('template/html/assets/js/plugins/slider-tabs.js') }}"></script>

        <!-- Form Wizard Script -->
        <script src="{{ asset('template/html/assets/js/plugins/form-wizard.js') }}"></script>

        <!-- AOS Animation Plugin-->
        <script src="{{ asset('template/html/assets/vendor/aos/dist/aos.js') }}"></script>

        <!-- App Script -->
        <script src="{{ asset('template/html/assets/js/hope-ui.js') }}" defer></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
            crossorigin="anonymous"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="{{ asset('js/script.js') }}"></script>

        {{-- <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script>
            $(function() {
                $('#users-table').DataTable({
                    processing: true,
                    serverSide: true,
                    bDestroy: true,
                    ajax: '{!! route('daftar-note-json') !!}', // memanggil route yang menampilkan data json
                    columns: [{ // mengambil & menampilkan kolom sesuai tabel database
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        }
                    ]
                });
            });
        </script> --}}
</body>

</html>
