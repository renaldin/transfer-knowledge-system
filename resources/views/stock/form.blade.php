@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{$subTitle}}</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="new-user-info">
                    <form action="@if($form === 'Tambah') /tambah-stok/{{$produk->id_product}} @elseif($form === 'Edit') /edit-stok/{{$produk->id_product}}/{{$detail->id_stock}} @endif" method="POST" id="stockForm">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="id_product">Produk</label>
                            <input type="hidden" class="form-control" name="id_product" id="id_product" value="{{$produk->id_product}}">
                            <input type="text" class="form-control" name="product_name" id="product_name" value="{{$produk->product_name}}" readonly>
                        </div>
                        @if ($form === 'Edit')
                            <div class="form-group col-md-6">
                                <label class="form-label" for="id_site">Site</label>
                                <input type="hidden" class="form-control" name="id_site" id="id_site" value="{{$detail->id_site}}">
                                <input type="text" class="form-control" name="site_name" id="site_name" value="{{$detail->site_name}}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="early_stock">Stok Awal</label>
                                <input type="text" class="form-control" name="early_stock" id="early_stock" value="{{$detail->early_stock}}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="last_stock">Stok Akhir</label>
                                <input type="text" class="form-control" name="last_stock" id="last_stock" value="{{$detail->last_stock}}" readonly>
                            </div>
                        @else
                            <div class="form-group col-md-6">
                                <label class="form-label" for="id_site">Site</label>
                                <select name="id_site" id="id_site" class="selectpicker form-control @error('id_site') is-invalid @enderror" data-live-search="true" required>
                                    @if ($form === 'Tambah')
                                        <option value="" selected disabled>-- Pilih --</option>
                                    @else
                                        <option value="{{$detail->id_site}}">{{$detail->site_name}} | {{$detail->site_address}}</option>
                                    @endif
                                    @foreach ($daftarSite as $item)
                                        <option value="{{$item->id_site}}" >{{$item->site_name}} | {{$item->site_address}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        
                        <div class="form-group col-md-6">
                            <label class="form-label" for="purchase_price">Harga Pembelian</label>
                            <input type="text" class="form-control @error('purchase_price') is-invalid @enderror" id="purchase_price" name="purchase_price" value="@if($form === 'Tambah'){{ old('purchase_price') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->purchase_price}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Harga Pembelian">
                            @error('purchase_price')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="sell_price_cash">Harga Jual Cash</label>
                            <input type="text" class="form-control @error('sell_price_cash') is-invalid @enderror" id="sell_price_cash" name="sell_price_cash" value="@if($form === 'Tambah'){{ old('sell_price_cash') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->sell_price_cash}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Harga Jual Cash">
                            @error('sell_price_cash')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="sell_price_tempo">Harga Jual Tempo</label>
                            <input type="text" class="form-control @error('sell_price_tempo') is-invalid @enderror" id="sell_price_tempo" name="sell_price_tempo" value="@if($form === 'Tambah'){{ old('sell_price_tempo') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->sell_price_tempo}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Harga Jual Tempo">
                            @error('sell_price_tempo')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    @include('components.tombolForm', ['linkKembali' => '/daftar-stok/'.$produk->id_product])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection