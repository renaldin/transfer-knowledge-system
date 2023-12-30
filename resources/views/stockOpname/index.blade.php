@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                <h4 class="card-title">Produk</h4>
                </div>
            </div>
            <div class="card-body px-4">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="form-label">Kode Produk</label>
                        <input type="text" class="form-control" value="{{$produk->product_code}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" value="{{$produk->product_name}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Harga Pembelian</label>
                        <input type="text" class="form-control" value="{{number_format($produk->purchase_price)}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Harga Jual Cash</label>
                        <input type="text" class="form-control" value="{{number_format($produk->sell_price_cash)}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Harga Jual Tempo</label>
                        <input type="text" class="form-control" value="{{number_format($produk->sell_price_tempo)}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Stok Awal</label>
                        <input type="text" class="form-control" value="{{$produk->early_stock}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Stok Terakhir</label>
                        <input type="text" class="form-control" value="{{$produk->last_stock}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" value="{{$produk->product_desc}}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                        <button type="button" data-bs-target="#tambah" data-bs-toggle="modal" class="btn btn-primary mb-3">Tambah</button>
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
                            <th>Kuantitas</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>User Input</th>
                            <th style="min-width: 100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($daftarStokOpname as $item)
                            @if ($item->id_product == $produk->id_product)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$item->product_name}}</td>
                                    <td>{{$item->quantity_opname}}</td>
                                    <td>{{$item->date_opname}}</td>
                                    <td>{{$item->desc_opname}}</td>
                                    <td>{{$item->fullname}}</td>
                                    <td>
                                        <div class="flex align-items-center list-user-action">
                                            <button type="button" class="btn btn-sm btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit" data-bs-target="#edit{{$item->id_stock_opname}}" data-bs-toggle="modal" >
                                                <span class="btn-inner">
                                                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#hapus{{$item->id_stock_opname}}" data-placement="top" title="Hapus" data-original-title="Delete">
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
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($daftarStokOpname as $item)
<div class="modal fade" id="hapus{{$item->id_stock_opname}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin akan hapus stok <strong>{{$item->product_name}}</strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <a href="/hapus-stok-opname/{{$item->id_stock_opname}}/{{$produk->id_product}}" type="button" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="/tambah-stok-opname" method="POST">
                        @csrf
                        <div class="form-group col-md-12">
                            <label class="form-label" for="quantity_opname">Kuantitas</label>
                            <input type="hidden" class="form-control" id="id_product" name="id_product" placeholder="Masukkan Kuantitas" value="{{$produk->id_product}}">
                            <input type="number" class="form-control" id="quantity_opname" name="quantity_opname" placeholder="Masukkan Kuantitas">
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label" for="date_opname">Tanggal</label>
                            <input type="date" class="form-control" id="date_opname" name="date_opname" placeholder="Masukkan Tanggal">
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label" for="desc_opname">Deskripsi</label>
                            <input type="text" class="form-control" id="desc_opname" name="desc_opname" placeholder="Masukkan Deskripsi">
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

@foreach ($daftarStokOpname as $item)
<div class="modal fade" id="edit{{$item->id_stock_opname}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="/edit-stok-opname/{{$item->id_stock_opname}}" method="POST">
                        @csrf
                        <div class="form-group col-md-12">
                            <label class="form-label" for="quantity_opname">Kuantitas</label>
                            <input type="hidden" class="form-control" id="id_product" name="id_product" placeholder="Masukkan Kuantitas" value="{{$produk->id_product}}">
                            <input type="number" class="form-control" id="quantity_opname" name="quantity_opname" value="{{$item->quantity_opname}}" placeholder="Masukkan Kuantitas">
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label" for="date_opname">Tanggal</label>
                            <input type="date" class="form-control" id="date_opname" name="date_opname" value="{{$item->date_opname}}" placeholder="Masukkan Tanggal">
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label" for="desc_opname">Deskripsi</label>
                            <input type="text" class="form-control" id="desc_opname" name="desc_opname" value="{{$item->desc_opname}}" placeholder="Masukkan Deskripsi">
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

@endsection