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
                    <form action="@if($form === 'Tambah') /tambah-target-store @elseif($form === 'Edit') /edit-target-store/{{$detail->id_target_store}} @endif" method="POST" enctype="multipart/form-data">
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
                            <label class="form-label" for="target_store_name">Nama Store</label>
                            <input type="text" class="form-control @error('target_store_name') is-invalid @enderror" id="target_store_name" name="target_store_name" value="@if($form === 'Tambah'){{ old('target_store_name') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->target_store_name}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Nama Store">
                            @error('target_store_name')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="target_store_owner">Owner</label>
                            <input type="text" class="form-control @error('target_store_owner') is-invalid @enderror" id="target_store_owner" name="target_store_owner" value="@if($form === 'Tambah'){{ old('target_store_owner') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->target_store_owner}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Owner">
                            @error('target_store_owner')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="target_store_mobile">Nomor Telepon Store</label>
                            <input type="text" class="form-control @error('target_store_mobile') is-invalid @enderror" id="target_store_mobile" name="target_store_mobile" value="@if($form === 'Tambah'){{ old('target_store_mobile') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->target_store_mobile}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Nomor Telepon Store" oninput="handleNumberOnly(this)">
                            @error('target_store_mobile')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="target_store_address">Alamat Store</label>
                            <input type="text" class="form-control @error('target_store_address') is-invalid @enderror" id="target_store_address" name="target_store_address" value="@if($form === 'Tambah'){{ old('target_store_address') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->target_store_address}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Alamat Store">
                            @error('target_store_address')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="reschedule_date">Tanggal Kunjungan Selanjutnya</label>
                            <input type="date" class="form-control @error('reschedule_date') is-invalid @enderror" id="reschedule_date" name="reschedule_date" value="@if($form === 'Tambah'){{ old('reschedule_date') }}@elseif($form === 'Edit' || $form === 'Detail'){{date('Y-m-d', strtotime($detail->reschedule_date))}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Tanggal">
                            @error('reschedule_date')
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
                            <label class="form-label" for="target_store_pict">Foto Store</label>
                            <input type="file" class="form-control @error('target_store_pict') is-invalid @enderror" id="preview_image_1" name="target_store_pict" @if($form === 'Detail') disabled @endif>
                            @error('target_store_pict')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="target_store_pict"></label>
                            <div class="profile-img-edit position-relative">
                                <img src="@if($form === 'Tambah') {{ asset('target_store/default1.jpg') }} @elseif($form === 'Edit' || $form === 'Detail') {{ asset('target_store/'.$detail->target_store_pict) }} @endif" alt="profile-pic" id="load_image_1" class="theme-color-default-img profile-pic rounded avatar-100">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="target_store_status">Status</label>
                            <select name="target_store_status" id="target_store_status" class="selectpicker form-control" data-live-search="true" required>
                                <option value="" selected disabled>-- Pilih --</option>
                                <option value="Closing" @if($form === 'Edit' && $detail->target_store_status === 'Closing') selected @elseif($form === 'Tambah' && old('target_store_status') === 'Closing') selected @endif>Closing</option>
                                <option value="Belum Closing" @if($form === 'Edit' && $detail->target_store_status === 'Belum Closing') selected @elseif($form === 'Tambah' && old('target_store_status') === 'Belum Closing') selected @endif>Belum Closing</option>
                            </select>
                            @error('target_store_status')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    @include('components.tombolForm', ['linkKembali' => '/daftar-target-store'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection