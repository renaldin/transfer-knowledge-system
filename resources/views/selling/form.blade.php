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
                    <form action="@if($form === 'Tambah') /tambah-penjualan @elseif($form === 'Edit') /edit-penjualan/{{$detail->id_sales}} @endif" method="POST" id="salesForm">
                    @csrf
                    <div class="row">
                        @if ($form === 'Tambah')
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
                        @else
                            <div class="form-group col-md-6">
                                <label class="form-label" for="id_site">Site</label>
                                <input type="hidden" class="form-control" id="id_site" name="id_site" value="{{$detail->id_site}}" readonly>
                                <input type="text" class="form-control" id="site_name" name="site_name" value="{{$detail->site_name}} | {{$detail->site_address}}" readonly>
                            </div>
                        @endif
                        <div class="form-group col-md-6">
                            <label class="form-label" for="sales_code">Kode Penjualan</label>
                            <input type="text" class="form-control @error('sales_code') is-invalid @enderror" id="sales_code" name="sales_code" value="@if($form === 'Tambah'){{ old('sales_code') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->sales_code}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Kode Penjualan">
                            @error('sales_code')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="sales_date">Tanggal</label>
                            <input type="date" class="form-control @error('sales_date') is-invalid @enderror" id="sales_date" name="sales_date" value="@if($form === 'Tambah'){{ old('sales_date') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->sales_date}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Nama Produk" required>
                            @error('sales_date')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="customer_name">Nama Pelanggan</label>
                            <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="@if($form === 'Tambah'){{ old('customer_name') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->customer_name}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Nama Pelanggan" required>
                            @error('customer_name')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="customer_address">Alamat</label>
                            <input type="text" class="form-control @error('customer_address') is-invalid @enderror" id="customer_address" name="customer_address" value="@if($form === 'Tambah'){{ old('customer_address') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->customer_address}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Alamat Pelanggan">
                            @error('customer_address')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="customer_phone">Nomor Telepon</label>
                            <input type="text" class="form-control @error('customer_phone') is-invalid @enderror" id="customer_phone" name="customer_phone" value="@if($form === 'Tambah'){{ old('customer_phone') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->customer_phone}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Nomor Telepon" oninput="handleNumberOnly(this)">
                            @error('customer_phone')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="payment_type">Tipe Pembayaran</label>
                            <select name="payment_type" id="payment_type" class="selectpicker form-control @error('payment_type') is-invalid @enderror" data-live-search="true" @if($form === 'Detail') disabled @endif required>
                                <option value="" selected disabled>-- Pilih --</option>
                                <option value="Cash" @if($form === "Tambah" && old("payment_type") === "Cash") selected @elseif($form === "Edit" && $detail->payment_type === "Cash") selected @endif)>Cash</option>
                                <option value="Tempo" @if($form === "Tambah" && old("payment_type") === "Tempo") selected @elseif($form === "Edit" && $detail->payment_type === "Tempo") selected @endif)>Tempo</option>
                            </select>
                            @error('payment_type')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="notes">Catatan</label>
                            <input type="text" class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" value="@if($form === 'Tambah'){{ old('notes') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->notes}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Alamat Pelanggan">
                            @error('notes')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    @include('components.tombolForm', ['linkKembali' => '/daftar-penjualan'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection