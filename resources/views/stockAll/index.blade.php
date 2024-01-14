@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Daftar Stok</h4>
                </div>
            </div>
            <div class="card-body px-4" style="margin-bottom: -50px;">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="/tambah-data-stok" class="btn btn-primary mb-3">Tambah</a>
                        <button type="button" data-bs-target="#filter" data-bs-toggle="modal" class="btn btn-primary mb-3">Filter</button>
                        @if ($filter)
                            <a href="/data-stok" class="btn btn-danger mb-3 mr-4">Reset Filter</a>
                            <strong>Filter By:</strong> {{$filterBy}}, <strong>Filter:</strong> {{$filterValue}}
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
                            <th>Nama Produk</th>
                            <th>Site</th>
                            <th>Harga Pembelian</th>
                            <th>Harga Jual Cash</th>
                            <th>Harga Jual Tempo</th>
                            <th>Stok Awal</th>
                            <th>Stok Akhir</th>
                            <th style="min-width: 100px">Aksi</th>
                        </tr>
                    </thead>
                    @if ($user->role === 'Admin Cabang')
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($daftarStok as $item)
                                @if (in_array($item->id_site, $siteUser))
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$item->product_name}}</td>
                                        <td>{{$item->site_name}}</td>
                                        <td>{{number_format($item->purchase_price)}}</td>
                                        <td>{{number_format($item->sell_price_cash)}}</td>
                                        <td>{{number_format($item->sell_price_tempo)}}</td>
                                        <td>{{$item->early_stock}}</td>
                                        <td>{{$item->last_stock}}</td>
                                        <td>
                                            <div class="flex align-items-center list-user-action">
                                                <a href="/edit-data-stok/{{$item->id_stock}}" class="btn btn-sm btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit">
                                                    <span class="btn-inner">
                                                        <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    @else
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($daftarStok as $item)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$item->product_name}}</td>
                                    <td>{{$item->site_name}}</td>
                                    <td>{{number_format($item->purchase_price)}}</td>
                                    <td>{{number_format($item->sell_price_cash)}}</td>
                                    <td>{{number_format($item->sell_price_tempo)}}</td>
                                    <td>{{$item->early_stock}}</td>
                                    <td>{{$item->last_stock}}</td>
                                    <td>
                                        <div class="flex align-items-center list-user-action">
                                            <a href="/edit-data-stok/{{$item->id_stock}}" class="btn btn-sm btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit">
                                                <span class="btn-inner">
                                                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($daftarStok as $item)
<div class="modal fade" id="hapus{{$item->id_stock}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Barang Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin akan hapus stok <strong>{{$item->product_name}}</strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <a href="/hapus-stok/{{$item->id_stock}}/{{$item->id_product}}" type="button" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="modal fade" id="filter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter Data Stok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="/data-stok" method="POST" id="filterStockForm">
                        @csrf
                        <div class="form-group col-md-12">
                            <label class="form-label" for="filter_by">Filter By</label>
                            <select name="filter_by" id="filter_by" class="selectpicker form-control" data-live-search="true" required>
                                <option value="" selected disabled>-- Pilih --</option>
                                <option value="Produk" >Produk</option>
                                <option value="Site" >Site</option>
                                <option value="Tanggal" >Tanggal</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label" for="id_product">Produk</label>
                            <select name="id_product" id="id_product" class="selectpicker form-control" data-live-search="true" >
                                <option value="" selected disabled>-- Pilih --</option>
                                @foreach ($daftarProduk as $item)
                                    <option value="{{$item->id_product}}" >{{$item->product_code}} | {{$item->product_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label" for="id_site">Site</label>
                            <select name="id_site" id="id_site" class="selectpicker form-control" data-live-search="true" >
                                <option value="" selected disabled>-- Pilih --</option>
                                @foreach ($daftarSite as $item)
                                    <option value="{{$item->id_site}}" >{{$item->site_name}} | {{$item->site_address}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label" for="date_from">Dari Tanggal</label>
                            <input type="date" class="form-control" id="date_from" name="date_from" placeholder="Masukkan Tanggal" >
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label" for="date_to">Sampai Tanggal</label>
                            <input type="date" class="form-control" id="date_to" name="date_to" placeholder="Masukkan Tanggal" >
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