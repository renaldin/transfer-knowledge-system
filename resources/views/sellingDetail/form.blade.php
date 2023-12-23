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
                            <label class="form-label" for="id_product">Produk</label>
                            <input type="hidden" name="id_sales" value="{{$sales->id_sales}}" id="">
                            <select name="id_product" id="id_product" class="selectpicker form-control @error('id_product') is-invalid @enderror" data-style="py-0" @if($form === 'Detail') disabled @endif required>
                                @if ($form === 'Tambah')
                                    <option value="" selected disabled>-- Pilih --</option>
                                @else
                                    <option value="{{$detail->id_product}}">{{$detail->product_code}} | {{$detail->product_name}}</option>
                                @endif
                                @foreach ($produk as $item)
                                    @if ($item->last_stock != 0)
                                        <option value="{{$item->id_product}}" >{{$item->product_code}} | {{$item->product_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('id_user')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="quantity_sales">QTY</label>
                            <input type="text" class="form-control @error('quantity_sales') is-invalid @enderror" id="quantity_sales" name="quantity_sales" value="@if($form === 'Tambah'){{ old('quantity_sales') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->quantity_sales}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Nomor Telepon" oninput="handleNumberOnly(this)">
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