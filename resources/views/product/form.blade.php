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
                    <form action="@if($form === 'Tambah') /tambah-produk @elseif($form === 'Edit') /edit-produk/{{$detail->id_product}} @endif" method="POST" id="productForm">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="product_code">Kode Produk</label>
                            <input type="text" class="form-control @error('product_code') is-invalid @enderror" id="product_code" name="product_code" value="@if($form === 'Tambah'){{ old('product_code') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->product_code}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Kode Produk">
                            @error('product_code')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="product_name">Nama Produk</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="@if($form === 'Tambah'){{ old('product_name') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->product_name}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Nama Produk" required>
                            @error('product_name')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="product_desc">Deskripsi</label>
                            <input type="text" class="form-control @error('product_desc') is-invalid @enderror" id="product_desc" name="product_desc" value="@if($form === 'Tambah'){{ old('product_desc') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->product_desc}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Deskripsi">
                            @error('product_desc')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
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
                    @include('components.tombolForm', ['linkKembali' => '/daftar-produk'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection