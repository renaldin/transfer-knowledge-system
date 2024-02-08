<aside class="sidebar sidebar-default navs-rounded-all ">
    <div class="sidebar-header d-flex align-items-center justify-content-start">
        <a href="#" class="navbar-brand">
            <h4 class="logo-title">
                <h4 class="logo-title">Sistem Project</h4>
            </h4>
        </a>
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" stroke="currentColor"></circle>                                                                    </svg>                                                          </svg>  
                        </i>
                        <span class="item-name">Dashboard</span>
                    </a>
                </li>
                <li>
                    <hr class="hr-horizontal">
                </li>
                @if ($user->role === 'Project Manager')
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">Data Master</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Pengguna') active @endif" aria-current="page" href="/daftar-pengguna">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" stroke="currentColor"></circle>                                                                    </svg>                                                          </svg>  
                            </i>
                            <span class="item-name">Pengguna</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Klien') active @endif" aria-current="page" href="/daftar-klien">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" stroke="currentColor"></circle>                                                                    </svg>                                                          </svg>  
                            </i>
                            <span class="item-name">Klien</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Proyek') active @endif" aria-current="page" href="/daftar-proyek">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" stroke="currentColor"></circle>                                                                    </svg>                                                          </svg>  
                            </i>
                            <span class="item-name">Proyek</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Catatan') active @endif" aria-current="page" href="/daftar-catatan">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" stroke="currentColor"></circle>                                                                    </svg>                                                          </svg>  
                            </i>
                            <span class="item-name">Catatan</span>
                        </a>
                    </li>
                @elseif ($user->role === 'Klien')
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">Operasi</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Store') active @endif" aria-current="page" href="/daftar-store">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" stroke="currentColor"></circle>                                                                    </svg>                               </svg>  
                            </i>
                            <span class="item-name">Data Store</span>
                        </a>
                    </li>
                @elseif ($user->role === 'CTO')
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">Data Master</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Pengguna') active @endif" aria-current="page" href="/daftar-pengguna">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" stroke="currentColor"></circle>                                                                    </svg>                                                          </svg>  
                            </i>
                            <span class="item-name">Pengguna</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Klien') active @endif" aria-current="page" href="/daftar-klien">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" stroke="currentColor"></circle>                                                                    </svg>                                                          </svg>  
                            </i>
                            <span class="item-name">Klien</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Proyek') active @endif" aria-current="page" href="/daftar-proyek">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" stroke="currentColor"></circle>                                                                    </svg>                                                          </svg>  
                            </i>
                            <span class="item-name">Proyek</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Catatan') active @endif" aria-current="page" href="/daftar-catatan">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" stroke="currentColor"></circle>                                                                    </svg>                                                          </svg>  
                            </i>
                            <span class="item-name">Catatan</span>
                        </a>
                    </li>
                @elseif ($user->role === 'CEO')
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">Data Master</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if ($title === 'Data Pengguna') active @endif" aria-current="page" href="/daftar-user">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-32" width="20" viewBox="0 0 24 24" fill="none">                                    <circle cx="12" cy="12" r="7.5" stroke="currentColor"></circle>                                                                    </svg>                              </svg>  
                            </i>
                            <span class="item-name">Pengguna</span>
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

