<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Site | {{ $subTitle }}</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('template/html/assets/images/favicon.ico') }}" />
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>

    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

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
                        <h4 class="logo-title">Sistem Site</h4>
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
            <div class="iq-navbar-header" style="height: 215px;">
                <div class="container-fluid iq-container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="flex-wrap d-flex justify-content-between align-items-center">
                                <div>
                                    @if ($subTitle === 'Dashboard')
                                        <h1>Hello, {{ $user->fullname }}
                                        </h1>
                                        <p>Selamat Datang Di Website Sistem Site.</p>
                                    @else
                                        <h1>{{ $subTitle }}</h1>
                                        <p>Silahkan Jelajahi {{ $subTitle }}.</p>
                                    @endif
                                </div>
                                <div>
                                    <a href="" class="btn btn-link btn-soft-light">
                                        @if ($title === null)
                                            {{ $subTitle }}
                                        @else
                                            {{ $title }} / {{ $subTitle }}
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="iq-header-img">
                    <img src="{{ asset('template/html/assets/images/dashboard/top-header.png') }}" alt="header"
                        class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ asset('template/html/assets/images/dashboard/top-header1.png') }}" alt="header"
                        class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ asset('template/html/assets/images/dashboard/top-header2.png') }}" alt="header"
                        class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ asset('template/html/assets/images/dashboard/top-header3.png') }}" alt="header"
                        class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ asset('template/html/assets/images/dashboard/top-header4.png') }}" alt="header"
                        class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ asset('template/html/assets/images/dashboard/top-header5.png') }}" alt="header"
                        class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
                </div>
            </div> <!-- Nav Header Component End -->
            <!--Nav End-->
        </div>
        <div class="conatiner-fluid content-inner mt-n5 py-0">

            {{-- content --}}
            @yield('content')

        </div>
        <!-- Footer Section Start -->
        <footer class="footer">
            <div class="footer-body">
                <ul class="left-panel list-inline mb-0 p-0">
                    <li class="list-inline-item"><a href="#">Sistem Site</a></li>
                </ul>
                <div class="right-panel">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script> Designed Sistem Site
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a href="/logout" type="button" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>

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

        <script>
            // umum
            function readImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#load_image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $('#preview_image').change(function() {
                readImage(this);
            })

            function readImage1(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#load_image_1').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $('#preview_image_1').change(function() {
                readImage1(this);
            })

            function readImage2(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#load_image_2').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $('#preview_image_2').change(function() {
                readImage2(this);
            })

            function readImage3(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#load_image_3').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $('#preview_image_3').change(function() {
                readImage3(this);
            })
        </script>

        <script>
            window.setTimeout(function() {
                $(".alert").fadeTo(2000, 0).slideUp(2000, function() {
                    $(this).remove();
                });
            }, 8000);
        </script>

        <!-- Select2 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            function handleNumberOnly(input) {
                input.value = input.value.replace(/[^0-9]/g, '');
            }
        </script>

        <script>
            document.getElementById("togglePassword").addEventListener("click", function () {
                var passwordField = document.getElementById("password");
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                } else {
                    passwordField.type = "password";
                }
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var formDetailInvoiceForm = document.getElementById('detailInvoiceForm');
                var productForm = document.getElementById('productForm');
                var stockForm = document.getElementById('stockForm');
                var bayarFormModal = document.getElementById('bayarFormModal');

                if (formDetailInvoiceForm) {
                    let add = document.getElementById('add');
                    let bill = document.getElementById('bill');
                    let remainingBalance = document.getElementById('remaining_balance');
                    let latitudeStore = document.getElementById('latitude_store').value;
                    let longitudeStore = document.getElementById('longitude_store').value;

                    let addValue = removeFormatting(add.value);
                    let billValue = removeFormatting(bill.value);
                    let remaining = parseInt(addValue) - parseInt(billValue);

                    add.value = formatRupiah(addValue);
                    remainingBalance.value = remaining.toLocaleString('id-ID');
                    add.addEventListener('keyup', function (e) {
                        let addValue = removeFormatting(add.value);
                        let billValue = removeFormatting(bill.value);
                        let remaining = parseInt(addValue) - parseInt(billValue);

                        add.value = formatRupiah(addValue);
                        remainingBalance.value = remaining.toLocaleString('id-ID');
                    });

                    function getCoordinates() {
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(function(position) {
                                var latitude = position.coords.latitude;
                                var longitude = position.coords.longitude;
                                const currentLatitude = document.getElementById('latitude').value = latitude;
                                const currentLongitude = document.getElementById('longitude').value = longitude;
                                const distance = getDistanceBetweenPoints(currentLatitude, currentLongitude, latitudeStore, longitudeStore);
                                document.getElementById('distance').value = distance.meters.toFixed(2);
                                document.getElementById('absensi').value = distance.meters < 100 ? 'Hadir': 'Tidak Hadir';
                            }, function(error) {
                                console.error('Error getting location:', error.message);
                            });
                        } else {
                            console.log('Geolocation is not supported by your browser.');
                        }
                    }

                    function getDistanceBetweenPoints(lat1, lon1, lat2, lon2) {
                        const theta = lon1 - lon2;
                        let miles = Math.acos(
                            Math.sin(deg2rad(lat1)) * Math.sin(deg2rad(lat2)) +
                            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * Math.cos(deg2rad(theta))
                        );

                        miles = rad2deg(miles);
                        miles = miles * 60 * 1.1515;
                        const feet = miles * 5280;
                        const yards = feet / 3;
                        const kilometers = miles * 1.609344;
                        const meters = kilometers * 1000;

                        return {
                            miles: miles,
                            feet: feet,
                            yards: yards,
                            kilometers: kilometers,
                            meters: meters
                        };
                    }

                    function deg2rad(deg) {
                        return deg * (Math.PI / 180);
                    }

                    function rad2deg(rad) {
                        return rad * (180 / Math.PI);
                    }

                    getCoordinates();
                }

                if(productForm) {
                    let purchasePrice = document.getElementById('purchase_price')
                    let sellPriceCash = document.getElementById('sell_price_cash')
                    let sellPriceTempo = document.getElementById('sell_price_tempo')

                    let purchasePriceValue = removeFormatting(purchasePrice.value);
                    let sellPriceCashValue = removeFormatting(sellPriceCash.value);
                    let sellPriceTempoValue = removeFormatting(sellPriceTempo.value);

                    purchasePrice.value = formatRupiah(purchasePriceValue);
                    sellPriceCash.value = formatRupiah(sellPriceCashValue);
                    sellPriceTempo.value = formatRupiah(sellPriceTempoValue);

                    purchasePrice.addEventListener('keyup', function (e) {
                        let purchasePriceValue = removeFormatting(purchasePrice.value);
                        purchasePrice.value = formatRupiah(purchasePriceValue);
                    });

                    sellPriceCash.addEventListener('keyup', function (e) {
                        let sellPriceCashValue = removeFormatting(sellPriceCash.value);
                        sellPriceCash.value = formatRupiah(sellPriceCashValue);
                    });

                    sellPriceTempo.addEventListener('keyup', function (e) {
                        let sellPriceTempoValue = removeFormatting(sellPriceTempo.value);
                        sellPriceTempo.value = formatRupiah(sellPriceTempoValue);
                    });
                }

                if(stockForm) {
                    let purchasePrice = document.getElementById('purchase_price')
                    let sellPriceCash = document.getElementById('sell_price_cash')
                    let sellPriceTempo = document.getElementById('sell_price_tempo')

                    let purchasePriceValue = removeFormatting(purchasePrice.value);
                    let sellPriceCashValue = removeFormatting(sellPriceCash.value);
                    let sellPriceTempoValue = removeFormatting(sellPriceTempo.value);

                    purchasePrice.value = formatRupiah(purchasePriceValue);
                    sellPriceCash.value = formatRupiah(sellPriceCashValue);
                    sellPriceTempo.value = formatRupiah(sellPriceTempoValue);

                    purchasePrice.addEventListener('keyup', function (e) {
                        let purchasePriceValue = removeFormatting(purchasePrice.value);
                        purchasePrice.value = formatRupiah(purchasePriceValue);
                    });

                    sellPriceCash.addEventListener('keyup', function (e) {
                        let sellPriceCashValue = removeFormatting(sellPriceCash.value);
                        sellPriceCash.value = formatRupiah(sellPriceCashValue);
                    });

                    sellPriceTempo.addEventListener('keyup', function (e) {
                        let sellPriceTempoValue = removeFormatting(sellPriceTempo.value);
                        sellPriceTempo.value = formatRupiah(sellPriceTempoValue);
                    });
                }

                if(bayarFormModal) {
                    let totalPay = document.getElementById('total_pay')

                    let totalPayValue = removeFormatting(totalPay.value);

                    totalPay.value = formatRupiah(totalPayValue);

                    totalPay.addEventListener('keyup', function (e) {
                        let totalPayValue = removeFormatting(totalPay.value);
                        totalPay.value = formatRupiah(totalPayValue);
                    });
                }

                function formatRupiah(angka, prefix) {
                    let number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }

                    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                    return prefix === undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                }

                function removeFormatting(value) {
                    return value.replace(/[^\d]/g, '');
                }
            });
        </script>

</body>

</html>
