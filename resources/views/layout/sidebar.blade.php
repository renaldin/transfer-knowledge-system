<aside class="sidebar sidebar-default navs-rounded-all ">
    <div class="sidebar-header d-flex align-items-center justify-content-start">
        <a href="#" class="navbar-brand">
            <h4 class="logo-title">
                <h4 class="logo-title">Sistem Site</h4>
            </h4>
        </a>
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true" style="background-color: #004899;">
                <i class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.25 12.2744L19.25 12.2744" stroke="white" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="white" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </i>
            </div>
     
    </div>
    <div class="sidebar-body pt-0 data-scrollbar">
        <div class="sidebar-list mb-5">
            <!-- Sidebar Menu Start -->
            <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                <li class="nav-item static-item">
                    <a class="nav-link static-item disabled" href="#" tabindex="-1">
                        <span class="default-icon">Home</span>
                        <span class="mini-icon">-</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if ($subTitle === 'Dashboard') active @endif" aria-current="page"
                    @if ($subTitle === 'Dashboard') @endif href="/dashboard">
                        <i class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" fill="currentColor" fill-opacity="0.4" stroke="currentColor"></circle>                                </svg>  
                        </i>
                        <span class="item-name">Dashboard</span>
                    </a>
                </li>
                <li>
                    <hr class="hr-horizontal">
                </li>
                @if ($user->role === 'Administrator')
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">Data Master</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data User') active @endif" aria-current="page" href="/daftar-user">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" fill="currentColor" fill-opacity="0.4" stroke="currentColor"></circle>                                </svg>  
                            </i>
                            <span class="item-name">Data User</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Produk') active @endif" data-bs-toggle="collapse"  href="#landing" role="button" aria-expanded="false" aria-controls="landing">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" fill="currentColor" fill-opacity="0.4" stroke="currentColor"></circle>                                </svg>                            
                            </i>
                            <span class="item-name">Manajemen Produk</span>
                            <i class="right-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </i>
                        </a>
                        <ul class="sub-nav collapse" id="landing" data-bs-parent="#sidebar-menu">
                            <li class="nav-item">
                                <a class="nav-link @if ($subTitle === 'Daftar Produk' || $subTitle === 'Data Stok') active @endif" href="/daftar-produk">
                                    <i class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <g>
                                                <circle cx="12" cy="12" r="8" fill="currentColor">
                                                </circle>
                                            </g>
                                        </svg>
                                    </i>
                                    <i class="sidenav-mini-icon"> A </i>
                                    <span class="item-name">Data Produk</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($subTitle === 'Daftar Stok') active @endif" href="/daftar-semua-stok">
                                    <i class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <g>
                                                <circle cx="12" cy="12" r="8" fill="currentColor">
                                                </circle>
                                            </g>
                                        </svg>
                                    </i>
                                    <i class="sidenav-mini-icon"> A </i>
                                    <span class="item-name">Data Stok</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($subTitle === 'Daftar Stok Opname') active @endif" href="/daftar-semua-stok-opname">
                                    <i class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <g>
                                                <circle cx="12" cy="12" r="8" fill="currentColor">
                                                </circle>
                                            </g>
                                        </svg>
                                    </i>
                                    <i class="sidenav-mini-icon"> A </i>
                                    <span class="item-name">Stok Opname</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Produk' || $title === 'Data Stok') active @endif" aria-current="page" href="/daftar-produk">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" fill="currentColor" fill-opacity="0.4" stroke="currentColor"></circle>                                </svg>  
                            </i>
                            <span class="item-name">Data Produk</span>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Site' || $title === 'Data Detail Site') active @endif" aria-current="page" href="/daftar-site">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" fill="currentColor" fill-opacity="0.4" stroke="currentColor"></circle>                                </svg>  
                            </i>
                            <span class="item-name">Data Site</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Store') active @endif" aria-current="page" href="/daftar-store">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" fill="currentColor" fill-opacity="0.4" stroke="currentColor"></circle>                                </svg>  
                            </i>
                            <span class="item-name">Data Store</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Target Store') active @endif" aria-current="page" href="/daftar-target-store">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" fill="currentColor" fill-opacity="0.4" stroke="currentColor"></circle>                                </svg>  
                            </i>
                            <span class="item-name">Data Target Store</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Invoice') active @endif" aria-current="page" href="/daftar-invoice">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" fill="currentColor" fill-opacity="0.4" stroke="currentColor"></circle>                                </svg>  
                            </i>
                            <span class="item-name">Data Invoice</span>
                        </a>
                    </li>
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">Transaksi</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Penjualan' || $title === 'Detail Penjualan') active @endif" aria-current="page" href="/daftar-penjualan">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" fill="currentColor" fill-opacity="0.4" stroke="currentColor"></circle>                                </svg>  
                            </i>
                            <span class="item-name">Penjualan</span>
                        </a>
                    </li>
                @elseif ($user->role === 'Sales')
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">Operasi</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Store') active @endif" aria-current="page" href="/daftar-store">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" fill="currentColor" fill-opacity="0.4" stroke="currentColor"></circle>                                </svg>  
                            </i>
                            <span class="item-name">Data Store</span>
                        </a>
                    </li>
                @elseif ($user->role === 'Admin Cabang')
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">Data Master</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data User') active @endif" aria-current="page" href="/daftar-user">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" fill="currentColor" fill-opacity="0.4" stroke="currentColor"></circle>                                </svg>  
                            </i>
                            <span class="item-name">Data User</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Site' || $title === 'Data Detail Site') active @endif" aria-current="page" href="/daftar-site">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" fill="currentColor" fill-opacity="0.4" stroke="currentColor"></circle>                                </svg>  
                            </i>
                            <span class="item-name">Data Site</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Store') active @endif" aria-current="page" href="/daftar-store">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" fill="currentColor" fill-opacity="0.4" stroke="currentColor"></circle>                                </svg>  
                            </i>
                            <span class="item-name">Data Store</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Target Store') active @endif" aria-current="page" href="/daftar-target-store">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" fill="currentColor" fill-opacity="0.4" stroke="currentColor"></circle>                                </svg>  
                            </i>
                            <span class="item-name">Data Target Store</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <br><br>
                </li>
            </ul>
            <!-- Sidebar Menu End -->
        </div>
    </div>
    <div class="sidebar-footer"></div>
</aside>

