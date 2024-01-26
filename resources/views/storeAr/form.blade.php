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
                    <form action="@if($form === 'Tambah') /tambah-store-ar @elseif($form === 'Edit') /edit-store-ar/{{$detail->id_store}} @endif" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="id_site">Site</label>
                            @if ($user->role === 'Administrator')
                                <select name="id_site" id="id_site" class="selectpicker form-control @error('id_site') is-invalid @enderror" data-live-search="true" @if($form === 'Detail') disabled @endif autofocus required>
                                    @if ($form === 'Tambah')
                                        <option value="" selected disabled>-- Pilih --</option>
                                    @else
                                        <option value="{{$detail->id_site}}">{{$detail->site_name}} | {{$detail->site_address}}</option>
                                    @endif
                                    @foreach ($daftarSiteAdmin as $item)
                                        <option value="{{$item->id_site}}" >{{$item->site_name}} | {{$item->site_address}}</option>
                                    @endforeach
                                </select>
                            @elseif ($user->role === 'Admin Cabang')
                                <select name="id_site" id="id_site" class="selectpicker form-control @error('id_site') is-invalid @enderror" data-live-search="true" @if($form === 'Detail') disabled @endif autofocus required>
                                    @if ($form === 'Tambah')
                                        <option value="" selected disabled>-- Pilih --</option>
                                    @else
                                        <option value="{{$detail->id_site}}">{{$detail->site_name}} | {{$detail->site_address}}</option>
                                    @endif
                                    @foreach ($siteUser as $item)
                                        <option value="{{$item->id_site}}" >{{$item->site_name}} | {{$item->site_address}}</option>
                                    @endforeach
                                </select>
                            @else
                                <select name="id_site" id="id_site" class="selectpicker form-control @error('id_site') is-invalid @enderror" data-live-search="true" @if($form === 'Detail') disabled @endif autofocus required>
                                    @if ($form === 'Tambah')
                                        <option value="" selected disabled>-- Pilih --</option>
                                    @else
                                        <option value="{{$detail->id_site}}">{{$detail->site_name}} | {{$detail->site_address}}</option>
                                    @endif
                                    @foreach ($daftarSite as $item)
                                        @if ($item->id_user === $user->id_user || $user->role === 'Administrator')
                                            <option value="{{$item->id_site}}" >{{$item->site_name}} | {{$item->site_address}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif
                            @error('id_site')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
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
                            <label class="form-label" for="store_code">Kode Store</label>
                            <input type="text" class="form-control @error('store_code') is-invalid @enderror" id="store_code" name="store_code" value="@if($form === 'Tambah'){{ old('store_code') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->store_code}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Kode Store">
                            @error('store_code')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="store_name">Nama Store</label>
                            <input type="text" class="form-control @error('store_name') is-invalid @enderror" id="store_name" name="store_name" value="@if($form === 'Tambah'){{ old('store_name') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->store_name}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Nama Store">
                            @error('store_name')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="owner_name">Owner</label>
                            <input type="text" class="form-control @error('owner_name') is-invalid @enderror" id="owner_name" name="owner_name" value="@if($form === 'Tambah'){{ old('owner_name') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->owner_name}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Owner">
                            @error('owner_name')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="store_mobile_phone">Nomor Telepon Store</label>
                            <input type="text" class="form-control @error('store_mobile_phone') is-invalid @enderror" id="store_mobile_phone" name="store_mobile_phone" value="@if($form === 'Tambah'){{ old('store_mobile_phone') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->store_mobile_phone}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Nomor Telepon Store" oninput="handleNumberOnly(this)">
                            @error('store_mobile_phone')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="store_address">Alamat Store</label>
                            <input type="text" class="form-control @error('store_address') is-invalid @enderror" id="store_address" name="store_address" value="@if($form === 'Tambah'){{ old('store_address') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->store_address}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Alamat Store">
                            @error('store_address')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="link_gmaps">Link Google Maps (<a href="https://www.google.com/maps" target="_blank">Cari</a>)</label>
                            <input type="text" class="form-control @error('link_gmaps') is-invalid @enderror" id="link_gmaps" name="link_gmaps" value="@if($form === 'Tambah'){{ old('link_gmaps') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->link_gmaps}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Link Google Maps">
                            @error('link_gmaps')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="latitude">Latitude</label>
                            <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" value="@if($form === 'Tambah'){{ old('latitude') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->latitude}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Latitude" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="longitude">Longitude</label>
                            <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" value="@if($form === 'Tambah'){{ old('longitude') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->longitude}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Longitude" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="description">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Masukkan Deskripsi">@if($form === 'Tambah'){{ old('description') }}@elseif($form === 'Edit'){{$detail->description}}@endif</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="store_pict">Foto Store</label>
                            <input type="file" class="form-control @error('store_pict') is-invalid @enderror" id="preview_image_1" name="store_pict" @if($form === 'Detail') disabled @endif>
                            @error('store_pict')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="store_pict"></label>
                            <div class="profile-img-edit position-relative">
                                <img src="@if($form === 'Tambah') {{ asset('store/default1.jpg') }} @elseif($form === 'Edit' || $form === 'Detail') {{ asset('store/'.$detail->store_pict) }} @endif" alt="profile-pic" id="load_image_1" class="theme-color-default-img profile-pic rounded avatar-100">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="ktp_pict">Foto KTP</label>
                            <input type="file" class="form-control @error('ktp_pict') is-invalid @enderror" id="preview_image_2" name="ktp_pict" @if($form === 'Detail') disabled @endif>
                            @error('ktp_pict')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="ktp_pict"></label>
                            <div class="profile-img-edit position-relative">
                                <img src="@if($form === 'Tambah') {{ asset('store_ktp/default1.jpg') }} @elseif($form === 'Edit' || $form === 'Detail') {{ asset('store_ktp/'.$detail->ktp_pict) }} @endif" alt="profile-pic" id="load_image_2" class="theme-color-default-img profile-pic rounded avatar-100">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="form_pict">Foto Formulir</label>
                            <input type="file" class="form-control @error('form_pict') is-invalid @enderror" id="preview_image_3" name="form_pict" @if($form === 'Detail') disabled @endif>
                            @error('form_pict')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="form_pict"></label>
                            <div class="profile-img-edit position-relative">
                                <img src="@if($form === 'Tambah') {{ asset('store_form/default1.jpg') }} @elseif($form === 'Edit' || $form === 'Detail') {{ asset('store_form/'.$detail->form_pict) }} @endif" alt="profile-pic" id="load_image_3" class="theme-color-default-img profile-pic rounded avatar-100">
                            </div>
                        </div>
                    </div>
                    @include('components.tombolForm', ['linkKembali' => '/daftar-store-ar'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection