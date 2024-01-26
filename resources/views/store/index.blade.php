@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                <h4 class="card-title">{{$subTitle}}</h4>
                </div>
            </div>
            <div class="card-body px-4" style="margin-bottom: -50px;">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="/tambah-store" class="btn btn-primary mb-3">Tambah</a>
                        @if ($user->role === 'Administrator')
                            <button type="button" data-bs-target="#filter" data-bs-toggle="modal" class="btn btn-primary mb-3">Filter</button>
                            @if ($filter)
                                <a href="/daftar-store" class="btn btn-danger mb-3 mr-4">Reset Filter</a>
                                <strong>Filter By:</strong> {{$filterBy}}, <strong>Filter:</strong> {{$filterValue}}
                            @endif
                        @endif
                    </div>
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
            </div>
            <div class="card-body px-0">
                <div class="table-responsive">
                <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                    <thead>
                        <tr class="ligth">
                            <th>No</th>
                            @if ($user->role === 'Administrator' || $user->role === 'Admin Cabang')
                            <th>Sales</th>
                            @endif
                            <th>Site</th>
                            <th>Kode Store</th>
                            <th>Nama Store</th>
                            <th>Owner</th>
                            <th>Status</th>
                            <th>Status AR</th>
                            <th style="min-width: 100px">Aksi</th>
                        </tr>
                    </thead>
                    @if ($user->role === 'Admin Cabang')
                        <tbody>
                            <?php $no = 1;?>
                            @foreach ($daftarStore as $item)
                                @if (in_array($item->id_site, $siteUser))
                                    @if ($item->store_status_ar == 'TRUE')
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sales{{$item->id_store}}">{{$item->fullname}}</button>
                                            </td>
                                            <td>{{$item->site_name}}</td>
                                            <td>{{$item->store_code}}</td>
                                            <td>{{$item->store_name}}</td>
                                            <td>{{$item->owner_name}}</td>
                                            <td>
                                                @if ($item->store_status == 1)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->store_status_ar == 'TRUE')
                                                    <span class="badge bg-success">{{$item->store_status_ar}}</span>
                                                @else
                                                    <span class="badge bg-danger">{{$item->store_status_ar}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="flex align-items-center list-user-action">
                                                    @if ($item->store_status_ar == 'TRUE')
                                                        <button type="button" class="btn btn-sm btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="Status AR" data-original-title="Status AR" data-bs-toggle="modal" data-bs-target="#status-ar{{$item->id_store}}">
                                                            <span class="btn-inner">
                                                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3345 2.75024H7.66549C4.64449 2.75024 2.75049 4.88924 2.75049 7.91624V16.0842C2.75049 19.1112 4.63549 21.2502 7.66549 21.2502H16.3335C19.3645 21.2502 21.2505 19.1112 21.2505 16.0842V7.91624C21.2505 4.88924 19.3645 2.75024 16.3345 2.75024Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M8.43994 12.0002L10.8139 14.3732L15.5599 9.6272" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                                                       
                                                            </span>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Status AR" data-original-title="Status AR" data-bs-toggle="modal" data-bs-target="#status-ar{{$item->id_store}}">
                                                            <span class="btn-inner">
                                                                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M14.3955 9.59497L9.60352 14.387" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.3971 14.3898L9.60107 9.59277" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3345 2.75024H7.66549C4.64449 2.75024 2.75049 4.88924 2.75049 7.91624V16.0842C2.75049 19.1112 4.63549 21.2502 7.66549 21.2502H16.3335C19.3645 21.2502 21.2505 19.1112 21.2505 16.0842V7.91624C21.2505 4.88924 19.3645 2.75024 16.3345 2.75024Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                                                     
                                                            </span>
                                                        </button>
                                                    @endif
                                                    @if ($item->store_status == 1)
                                                        <button type="button" class="btn btn-sm btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="Status" data-original-title="Status" data-bs-toggle="modal" data-bs-target="#status{{$item->id_store}}">
                                                            <span class="btn-inner">
                                                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M16.4242 5.56204C15.8072 3.78004 14.1142 2.50004 12.1222 2.50004C9.60925 2.49004 7.56325 4.51804 7.55225 7.03104V7.05104V9.19804" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.933 21.0005H8.292C6.198 21.0005 4.5 19.3025 4.5 17.2075V12.9195C4.5 10.8245 6.198 9.12646 8.292 9.12646H15.933C18.027 9.12646 19.725 10.8245 19.725 12.9195V17.2075C19.725 19.3025 18.027 21.0005 15.933 21.0005Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.1128 13.9526V16.1746" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                                            </span>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Status" data-original-title="Status" data-bs-toggle="modal" data-bs-target="#status{{$item->id_store}}">
                                                            <span class="btn-inner">
                                                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M16.4232 9.4478V7.3008C16.4232 4.7878 14.3852 2.7498 11.8722 2.7498C9.35925 2.7388 7.31325 4.7668 7.30225 7.2808V7.3008V9.4478" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.683 21.2497H8.042C5.948 21.2497 4.25 19.5527 4.25 17.4577V13.1687C4.25 11.0737 5.948 9.37671 8.042 9.37671H15.683C17.777 9.37671 19.475 11.0737 19.475 13.1687V17.4577C19.475 19.5527 17.777 21.2497 15.683 21.2497Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.8628 14.2026V16.4236" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                                            </span>
                                                        </button>
                                                    @endif
                                                    <a href="/detail-store/{{$item->id_store}}" class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="Detail" data-original-title="Detail">
                                                        <span class="btn-inner">
                                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>                                    <circle cx="12" cy="12" r="5" stroke="currentColor"></circle>                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    </mask>                                    <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle>                                    </svg>                                
                                                        </span>
                                                    </a>
                                                    <a class="btn btn-sm btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit" href="/edit-store/{{$item->id_store}}">
                                                        <span class="btn-inner">
                                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#hapus{{$item->id_store}}" data-placement="top" title="Hapus User" data-original-title="Delete">
                                                        <span class="btn-inner">
                                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                            <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    @else
                        <tbody>
                            <?php $no = 1;?>
                            @foreach ($daftarStore as $item)
                                @if ($user->id_user === $item->id_user || $user->role === 'Administrator')
                                    @if ($item->store_status_ar == 'TRUE')
                                        <tr>
                                            <td>{{$no++}}</td>
                                            @if ($user->role === 'Administrator')
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sales{{$item->id_store}}">{{$item->fullname}}</button>
                                                </td>
                                            @endif
                                            <td>{{$item->site_name}}</td>
                                            <td>{{$item->store_code}}</td>
                                            <td>{{$item->store_name}}</td>
                                            <td>{{$item->owner_name}}</td>
                                            <td>
                                                @if ($item->store_status == 1)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->store_status_ar == 'TRUE')
                                                    <span class="badge bg-success">{{$item->store_status_ar}}</span>
                                                @else
                                                    <span class="badge bg-danger">{{$item->store_status_ar}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="flex align-items-center list-user-action">
                                                    @if ($item->store_status_ar == 'TRUE')
                                                        <button type="button" class="btn btn-sm btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="Status AR" data-original-title="Status AR" data-bs-toggle="modal" data-bs-target="#status-ar{{$item->id_store}}">
                                                            <span class="btn-inner">
                                                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3345 2.75024H7.66549C4.64449 2.75024 2.75049 4.88924 2.75049 7.91624V16.0842C2.75049 19.1112 4.63549 21.2502 7.66549 21.2502H16.3335C19.3645 21.2502 21.2505 19.1112 21.2505 16.0842V7.91624C21.2505 4.88924 19.3645 2.75024 16.3345 2.75024Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M8.43994 12.0002L10.8139 14.3732L15.5599 9.6272" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                                                       
                                                            </span>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Status AR" data-original-title="Status AR" data-bs-toggle="modal" data-bs-target="#status-ar{{$item->id_store}}">
                                                            <span class="btn-inner">
                                                                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M14.3955 9.59497L9.60352 14.387" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M14.3971 14.3898L9.60107 9.59277" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3345 2.75024H7.66549C4.64449 2.75024 2.75049 4.88924 2.75049 7.91624V16.0842C2.75049 19.1112 4.63549 21.2502 7.66549 21.2502H16.3335C19.3645 21.2502 21.2505 19.1112 21.2505 16.0842V7.91624C21.2505 4.88924 19.3645 2.75024 16.3345 2.75024Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                                                     
                                                            </span>
                                                        </button>
                                                    @endif
                                                    @if ($item->store_status == 1)
                                                        <button type="button" class="btn btn-sm btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="Status" data-original-title="Status" data-bs-toggle="modal" data-bs-target="#status{{$item->id_store}}">
                                                            <span class="btn-inner">
                                                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M16.4242 5.56204C15.8072 3.78004 14.1142 2.50004 12.1222 2.50004C9.60925 2.49004 7.56325 4.51804 7.55225 7.03104V7.05104V9.19804" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.933 21.0005H8.292C6.198 21.0005 4.5 19.3025 4.5 17.2075V12.9195C4.5 10.8245 6.198 9.12646 8.292 9.12646H15.933C18.027 9.12646 19.725 10.8245 19.725 12.9195V17.2075C19.725 19.3025 18.027 21.0005 15.933 21.0005Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.1128 13.9526V16.1746" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                                            </span>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Status" data-original-title="Status" data-bs-toggle="modal" data-bs-target="#status{{$item->id_store}}">
                                                            <span class="btn-inner">
                                                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M16.4232 9.4478V7.3008C16.4232 4.7878 14.3852 2.7498 11.8722 2.7498C9.35925 2.7388 7.31325 4.7668 7.30225 7.2808V7.3008V9.4478" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.683 21.2497H8.042C5.948 21.2497 4.25 19.5527 4.25 17.4577V13.1687C4.25 11.0737 5.948 9.37671 8.042 9.37671H15.683C17.777 9.37671 19.475 11.0737 19.475 13.1687V17.4577C19.475 19.5527 17.777 21.2497 15.683 21.2497Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M11.8628 14.2026V16.4236" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                                            </span>
                                                        </button>
                                                    @endif
                                                    <a href="/detail-store/{{$item->id_store}}" class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="Detail" data-original-title="Detail">
                                                        <span class="btn-inner">
                                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>                                    <circle cx="12" cy="12" r="5" stroke="currentColor"></circle>                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    </mask>                                    <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle>                                    </svg>                                
                                                        </span>
                                                    </a>
                                                    <a class="btn btn-sm btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit" href="/edit-store/{{$item->id_store}}">
                                                        <span class="btn-inner">
                                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#hapus{{$item->id_store}}" data-placement="top" title="Hapus User" data-original-title="Delete">
                                                        <span class="btn-inner">
                                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                            <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    @endif
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($daftarStore as $item)
<div class="modal fade" id="hapus{{$item->id_store}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin akan hapus store <strong>{{$item->store_name}}</strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <a href="/hapus-store/{{$item->id_store}}" type="button" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($daftarStore as $item)
<div class="modal fade" id="status{{$item->id_store}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/status/{{$item->id_store}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group col-md-6">
                            <label class="form-label">Aktif</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="store_status" id="flexSwitchCheckDefault" @if($item->store_status == 1) checked @endif>
                                <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($daftarStore as $item)
<div class="modal fade" id="sales{{$item->id_store}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sales</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table>
                            <tr>
                                <th>Kode Sales</th>
                                <td>:</td>
                                <td>{{$item->user_code}}</td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td>:</td>
                                <td>{{$item->fullname}}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>:</td>
                                <td>{{$item->user_address}}</td>
                            </tr>
                            <tr>
                                <th>Nomor Telepon</th>
                                <td>:</td>
                                <td>{{$item->mobile_phone}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>:</td>
                                <td>{{$item->email}}</td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>:</td>
                                <td>{{$item->username}}</td>
                            </tr>
                            <tr>
                                <th>Foto</th>
                                <td>:</td>
                                <td>
                                    <div class="profile-img-edit position-relative">
                                        <img src="{{ asset('photo/'.$item->photo) }} " alt="profile-pic" id="load_image" class="theme-color-default-img profile-pic rounded avatar-100">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($daftarStore as $item)
<div class="modal fade" id="status-ar{{$item->id_store}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Status AR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/store-status/{{$item->id_store}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group col-md-12">
                            <label class="form-label">Status AR</label>
                            <select name="store_status_ar" id="store_status_ar" class="selectpicker form-control" required>
                                <option value="" selected disabled>-- Pilih --</option>
                                <option value="TRUE" @if($item->store_status_ar == 'TRUE') selected @endif>TRUE</option>
                                <option value="FALSE" @if($item->store_status_ar == 'FALSE') selected @endif>FALSE</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="modal fade" id="filter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter Data Downline</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="/daftar-store" method="POST" id="filterDownlineForm">
                        @csrf
                        <div class="form-group col-md-12">
                            <label class="form-label" for="filter_by">Filter By</label>
                            <select name="filter_by" id="filter_by" class="form-control" data-live-search="true" required>
                                <option value="" selected disabled>-- Pilih --</option>
                                <option value="Sales" >Sales</option>
                                <option value="Site" >Site</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label" for="id_user">Sales</label>
                            <select name="id_user" id="id_user" class="form-control" data-live-search="true" >
                                <option value="" selected disabled>-- Pilih --</option>
                                @foreach ($daftarUser as $item)
                                    @if ($item->role === 'Sales')
                                        <option value="{{$item->id_user}}" >{{$item->fullname}} | {{$item->user_address}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label" for="id_site">Site</label>
                            <select name="id_site" id="id_site" class="form-control" data-live-search="true" >
                                <option value="" selected disabled>-- Pilih --</option>
                                @foreach ($daftarSite as $item)
                                    <option value="{{$item->id_site}}" >{{$item->site_name}} | {{$item->site_address}}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection