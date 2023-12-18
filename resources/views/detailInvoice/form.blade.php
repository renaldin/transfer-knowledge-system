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
                    <form action="/edit-detail-invoice/{{$detail->id_detail_invoice}}" id="detailInvoiceForm">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label">ID</label>
                            <input type="hidden" class="form-control" name="id_invoice" value="{{$detail->id_invoice}}" readonly>
                            <input type="text" class="form-control" value="{{$detail->store_code}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Nama Store</label>
                            <input type="text" class="form-control" value="{{$detail->store_name}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Tagihan</label>
                            <input type="text" id="bill" class="form-control" value="{{number_format($detail->bill)}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Limit</label>
                            <input type="text" class="form-control" value="{{number_format($detail->limit)}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Harga Group</label>
                            <input type="text" class="form-control" value="{{$detail->group_price}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Tanggal Aktifasi</label>
                            <input type="text" class="form-control" value="{{date('d-m-Y', strtotime($detail->activation_date))}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Latitude Store</label>
                            <input type="text" class="form-control" id="latitude_store" value="{{$detailStore->latitude ? $detailStore->latitude : '-'}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Longitude Store</label>
                            <input type="text" class="form-control" id="longitude_store" value="{{$detailStore->longitude ? $detailStore->longitude : '-'}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="add">Add</label>
                            <input type="text" class="form-control @error('add') is-invalid @enderror" id="add" name="add" value="@if($form === 'Tambah'){{ old('add') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->add}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Add" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="remaining_balance">Saldo Tersisa</label>
                            <input type="text" class="form-control @error('remaining_bzalance') is-invalid @enderror" id="remaining_balance" name="remaining_balance" value="@if($form === 'Tambah'){{ old('remaining_balance') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->remaining_balance}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Saldo Tersisa" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="notes">Catatan</label>
                            <input type="text" class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" value="@if($form === 'Tambah'){{ old('notes') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->notes}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Catatan">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="notes">Kunjungan</label>
                            <div class="form-check d-block">
                                <input class="form-check-input" type="radio" name="visit" value="1" id="visit1" @if($form === 'Edit' && $detail->visit == 1) checked @endif>
                                <label class="form-check-label" for="visit1">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check d-block">
                                <input class="form-check-input" type="radio" name="visit" value="0" id="visit2" @if($form === 'Edit' && $detail->visit == 0) checked @endif>
                                <label class="form-check-label" for="visit2">
                                    Tidak
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="latitude">Latitude</label>
                            <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" value="@if($form === 'Tambah'){{ old('latitude') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->latitude}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Latitude" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="longitude">Longitude</label>
                            <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" value="@if($form === 'Tambah'){{ old('longitude') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->longitude}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Longitude" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="distance">Jarak (Meter)</label>
                            <input type="text" class="form-control @error('distance') is-invalid @enderror" id="distance" name="distance" value="@if($form === 'Tambah'){{ old('distance') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->distance}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Jarak" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="absensi">Absensi <small class="text-danger"> pastikan Anda berjarak kurang dari 100 M agar Hadir</small></label>
                            <input type="text" class="form-control @error('absensi') is-invalid @enderror" id="absensi" name="absensi" value="@if($form === 'Tambah'){{ old('absensi') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->absensi}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Absensi" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="notes_for_salesman">Catatan Untuk Sales</label>
                            <input type="text" class="form-control @error('notes_for_salesman') is-invalid @enderror" id="notes_for_salesman" name="notes_for_salesman" value="@if($form === 'Tambah'){{ old('notes_for_salesman') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->notes_for_salesman}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Catatan Untuk Sales">
                        </div>
                    </div>
                    @include('components.tombolForm', ['linkKembali' => "/detail-invoice/$detail->id_invoice"])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection