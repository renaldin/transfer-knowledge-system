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
                    <form action="@if($form === 'Tambah') /tambah-site @elseif($form === 'Edit') /edit-site/{{$detail->id_site}} @endif" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="site_name">Nama Site</label>
                            <input type="text" class="form-control @error('site_name') is-invalid @enderror" id="site_name" name="site_name" value="@if($form === 'Tambah'){{ old('site_name') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->site_name}}@endif" @if($form === 'Detail') disabled @endif autofocus placeholder="Masukkan Nama Site" required>
                            @error('site_name')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="site_address">Alamat Site</label>
                            <input type="text" class="form-control @error('site_address') is-invalid @enderror" id="site_address" name="site_address" value="@if($form === 'Tambah'){{ old('site_address') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->site_address}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Alamat Site">
                            @error('site_address')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    @include('components.tombolForm', ['linkKembali' => '/daftar-site'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection