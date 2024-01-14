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
                <div class="row">
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
                <div class="new-user-info">
                    <form action="@if($form === 'Tambah') /tambah-detail-penjualan/{{$sales->id_sales}} @elseif($form === 'Edit') /edit-detail-penjualan/{{$detail->id_sales_detail}}/{{$sales->id_sales}} @endif" method="POST" id="salesForm">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="id_stock">Produk</label>
                            <input type="hidden" name="id_sales" value="{{$sales->id_sales}}" id="">
                            @if ($form === 'Edit')
                            <input type="hidden" name="id_stock" value="{{$detail->id_stock}}" id="">
                            @endif
                            <select name="id_stock" id="id_stock" class="selectpicker form-control @error('id_stock') is-invalid @enderror" data-live-search="true" @if($form === 'Edit') disabled @endif @if($form === 'Tambah') required @endif>
                                @if ($form === 'Tambah')
                                    <option value="" selected disabled>-- Pilih --</option>
                                @else
                                    <option value="{{$detail->id_stock}}">{{$detail->product_code}} | {{$detail->product_name}} | Stok: {{$detail->last_stock}} | {{$detail->site_name}}</option>
                                @endif
                                @foreach ($stock as $item)
                                    @if ($item->last_stock != 0 && $item->id_site == $sales->id_site)
                                        <option value="{{$item->id_stock}}">{{$item->product_code}} | {{$item->product_name}} | Stok: {{$item->last_stock}} | {{$item->site_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('id_stock')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="quantity_sales">QTY</label>
                            <input type="text" class="form-control @error('quantity_sales') is-invalid @enderror" id="quantity_sales" name="quantity_sales" value="@if($form === 'Tambah'){{ old('quantity_sales') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->quantity_sales}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan QTY" oninput="handleNumberOnly(this)">
                            @error('quantity_sales')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    @include('components.tombolForm', ['linkKembali' => '/detail-penjualan/'.$sales->id_sales])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection