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
                    <form action="@if($form === 'Tambah') /tambah-detail-penjualan/{{$sales->id_sales}} @elseif($form === 'Edit') /edit-detail-penjualan/{{$detail->id_sales_detail}}/{{$sales->id_sales}} @endif" method="POST" id="salesForm">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="id_stock">Produk</label>
                            <input type="hidden" name="id_sales" value="{{$sales->id_sales}}" id="">
                            @if ($form === 'Edit')
                            <input type="hidden" name="id_stock" value="{{$detail->id_stock}}" id="">
                            @endif
                            <select name="id_stock" id="id_stock" class="selectpicker form-control @error('id_stock') is-invalid @enderror" data-style="py-0" @if($form === 'Edit') disabled @endif @if($form === 'Tambah') required @endif>
                                @if ($form === 'Tambah')
                                    <option value="" selected disabled>-- Pilih --</option>
                                @else
                                    <option value="{{$detail->id_stock}}">{{$detail->product_code}} | {{$detail->product_name}} | {{$detail->site_name}}</option>
                                @endif
                                @foreach ($stock as $item)
                                    @if ($item->last_stock != 0)
                                        <option value="{{$item->id_stock}}">{{$item->product_code}} | {{$item->product_name}} | {{$item->site_name}}</option>
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