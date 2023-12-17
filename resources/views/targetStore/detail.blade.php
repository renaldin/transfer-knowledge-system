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
                            <label class="form-label" for="store_name">Nama Store</label>
                            <input type="text" class="form-control" value="{{$detail->target_store_name}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="owner_name">Owner</label>
                            <input type="text" class="form-control" value="{{$detail->target_store_owner}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="store_mobile_phone">Nomor Telepon Store</label>
                            <input type="text" class="form-control" value="{{$detail->target_store_mobile}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="store_address">Alamat Store</label>
                            <input type="text" class="form-control" value="{{$detail->target_store_address}}"readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="description">Deskripsi</label>
                            <textarea class="form-control" rows="5" readonly>{{$detail->description}}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="store_address">Status</label>
                            <input type="text" class="form-control" value="{{$detail->target_store_status}}"readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="reschedule_date">Tanggal Kunjungan Selanjutnya</label>
                            <input type="text" class="form-control" value="{{date('d-m-Y', strtotime($detail->reschedule_date))}}"readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="store_address">Latitude</label>
                            <input type="text" class="form-control" value="{{$detail->latitude}}"readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="store_address">Longitude</label>
                            <input type="text" class="form-control" value="{{$detail->longitude}}"readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="form-label">Tambahan</label>
                        </div>
                        <div class="form-group col-md-6 text-center">
                            <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#storePict">Foto Store</button>
                        </div>
                    </div>
                    <a href="/daftar-target-store" class="btn btn-secondary mb-1 float-end">Kembali</a>
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
                        <img src="{{ asset('target_store/'.$detail->target_store_pict) }}" alt="profile-pic" class="theme-color-default-img profile-pic" width="100%">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

@endsection