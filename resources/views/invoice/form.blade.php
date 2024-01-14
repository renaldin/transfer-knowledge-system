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
                    <form action="/edit-invoice/{{$detail->id_invoice}}">
                    @csrf
                    <div class="row">
                        @if ($user->role === 'Administrator')
                            <div class="form-group col-md-6">
                                <label class="form-label" for="id_site">Sales</label>
                                <select name="id_user" id="id_user" class="selectpicker form-control @error('id_user') is-invalid @enderror" data-live-search="true" @if($form === 'Detail') disabled @endif required>
                                    @if ($form === 'Tambah')
                                        <option value="" selected disabled>-- Pilih --</option>
                                    @else
                                        <option value="{{$detail->id_user}}">{{$detail->fullname}} | {{$detail->user_address}}</option>
                                    @endif
                                    @foreach ($daftarUser as $item)
                                        @if ($item->role === 'Sales')
                                            <option value="{{$item->id_user}}" >{{$item->fullname}} | {{$item->user_address}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_user')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @elseif($user->role === 'Admin Cabang')
                            <div class="form-group col-md-6">
                                <label class="form-label" for="id_site">Sales</label>
                                <select name="id_user" id="id_user" class="selectpicker form-control @error('id_user') is-invalid @enderror" data-live-search="true" @if($form === 'Detail') disabled @endif required>
                                    @if ($form === 'Tambah')
                                        <option value="" selected disabled>-- Pilih --</option>
                                    @else
                                        <option value="{{$detail->id_user}}">{{$detail->fullname}} | {{$detail->user_address}}</option>
                                    @endif
                                    @foreach ($dataUser as $item)
                                        <option value="{{$item->id_user}}" >{{$item->fullname}} | {{$item->user_address}}</option>
                                    @endforeach
                                </select>
                                @error('id_user')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                        <div class="form-group col-md-6">
                            <label class="form-label" for="date">Tanggal</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="@if($form === 'Tambah'){{ old('date') }}@elseif($form === 'Edit' || $form === 'Detail'){{date('Y-m-d', strtotime($detail->date))}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Tanggal" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="day">Hari</label>
                            <input type="text" class="form-control @error('day') is-invalid @enderror" id="day" name="day" value="@if($form === 'Tambah'){{ old('day') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->day}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Hari" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="user_code_invoice">Kode User</label>
                            <input type="text" class="form-control @error('user_code_invoice') is-invalid @enderror" id="user_code_invoice" name="user_code_invoice" value="@if($form === 'Tambah'){{ old('user_code_invoice') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->user_code_invoice}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Hari" required>
                        </div>
                    </div>
                    @include('components.tombolForm', ['linkKembali' => '/daftar-invoice'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection