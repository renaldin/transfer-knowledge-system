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
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="id_site">Site</label>
                            <input type="text" class="form-control" value="{{$detail->site_name}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="id_site">Alamat Site</label>
                            <input type="text" class="form-control" value="{{$detail->site_address}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="store_code">Kode Store</label>
                            <input type="text" class="form-control" value="{{$detail->store_code}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="store_name">Nama Store</label>
                            <input type="text" class="form-control" value="{{$detail->store_name}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="owner_name">Owner</label>
                            <input type="text" class="form-control" value="{{$detail->owner_name}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="store_mobile_phone">Nomor Telepon Store</label>
                            <input type="text" class="form-control" value="{{$detail->store_mobile_phone}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="store_address">Alamat Store</label>
                            <input type="text" class="form-control" value="{{$detail->store_address}}"readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="description">Deskripsi</label>
                            <textarea class="form-control" rows="5" readonly>{{$detail->description}}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="form-label">Tambahan</label>
                        </div>
                        <div class="form-group col-md-6 text-center">
                            <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#storePict">Foto Store</button>
                            <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#ktpPict">Foto KTP</button>
                            <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#formPict">Foto Formulir</button>
                            <a href="{{$detail->link_gmaps}}" class="btn btn-primary mb-1" target="_blank">Google Maps</a>
                        </div>
                    </div>
                    <a href="/daftar-store" class="btn btn-secondary mb-1 float-end">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="storePict" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Foto Store</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ asset('store/'.$detail->store_pict) }}" alt="profile-pic" class="theme-color-default-img profile-pic" width="100%">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ktpPict" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Foto KTP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ asset('store_ktp/'.$detail->ktp_pict) }}" alt="profile-pic" class="theme-color-default-img profile-pic" width="100%">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <a href="{{public_path('store_ktp/'.$detail->ktp_pict)}}" download="nama.jpg" class="btn btn-primary">Download</a> --}}
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formPict" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Foto Formulir</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ asset('store_form/'.$detail->form_pict) }}" alt="profile-pic" class="theme-color-default-img profile-pic" width="100%">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

{{-- <div class="modal fade" id="maps" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Google Maps</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <?= $detail->link_gmaps ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div> --}}

@endsection