@extends('layout.main')

@section('content')
<div class="row mb-2">
    <div class="col-md-12">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#manager">Manager</button>
        <a href="/data-kaderisasi" class="btn btn-light">Kembali</a>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Karyawan Senior</div>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="mb-3 col-md-12">
                        <label for="full_name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="full_name" id="full_name" value="{{$detail->seniorEmployee?->full_name}}" @if($form == 'Detail') disabled @endif>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" name="nik" id="nik" value="{{$detail->seniorEmployee?->nik}}" @if($form == 'Detail') disabled @endif>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="birth_date" class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control" name="birth_date" id="birth_date" value="{{$detail->seniorEmployee?->birth_date}}" @if($form == 'Detail') disabled @endif>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="{{$detail->seniorEmployee?->user?->email}}" @if($form == 'Detail') disabled @endif>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="address" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="address" id="address" value="{{$detail->seniorEmployee?->address}}" @if($form == 'Detail') disabled @endif>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="job_code" class="form-label">Kode Pekerjaan</label>
                        <input type="text" class="form-control" name="job_code" id="job_code" value="{{$detail->seniorEmployee?->job_code}}" @if($form == 'Detail') disabled @endif>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="job_title" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" name="job_title" id="job_title" value="{{$detail->seniorEmployee?->job_title}}" @if($form == 'Detail') disabled @endif>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="organization" class="form-label">Organisasi</label>
                        <input type="text" class="form-control" name="organization" id="organization" value="{{$detail->seniorEmployee?->organization}}" @if($form == 'Detail') disabled @endif>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="photo" class="form-label"></label>
                        <img src="@if($form == 'Edit' || $form == 'Detail' && $detail->seniorEmployee?->user?->photo) {{ asset('photo/'.$detail->seniorEmployee?->user?->photo) }} @else {{ asset('photo/default.jpg') }} @endif" class="rounded-circle" alt="" style="width: 200px;" id="load_image">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Karyawan Junior</div>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="mb-3 col-md-12">
                        <label for="full_name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="full_name" id="full_name" value="{{$detail->juniorEmployee?->full_name}}" @if($form == 'Detail') disabled @endif>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" name="nik" id="nik" value="{{$detail->juniorEmployee?->nik}}" @if($form == 'Detail') disabled @endif>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="birth_date" class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control" name="birth_date" id="birth_date" value="{{$detail->juniorEmployee?->birth_date}}" @if($form == 'Detail') disabled @endif>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="{{$detail->juniorEmployee?->user?->email}}" @if($form == 'Detail') disabled @endif>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="address" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="address" id="address" value="{{$detail->juniorEmployee?->address}}" @if($form == 'Detail') disabled @endif>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="job_code" class="form-label">Kode Pekerjaan</label>
                        <input type="text" class="form-control" name="job_code" id="job_code" value="{{$detail->juniorEmployee?->job_code}}" @if($form == 'Detail') disabled @endif>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="job_title" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" name="job_title" id="job_title" value="{{$detail->juniorEmployee?->job_title}}" @if($form == 'Detail') disabled @endif>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="organization" class="form-label">Organisasi</label>
                        <input type="text" class="form-control" name="organization" id="organization" value="{{$detail->juniorEmployee?->organization}}" @if($form == 'Detail') disabled @endif>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="photo" class="form-label"></label>
                        <img src="@if($form == 'Edit' || $form == 'Detail' && $detail->juniorEmployee?->user?->photo) {{ asset('photo/'.$detail->juniorEmployee?->user?->photo) }} @else {{ asset('photo/default.jpg') }} @endif" class="rounded-circle" alt="" style="width: 200px;" id="load_image">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="manager" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Manager</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="">
                            <div class="mb-3 col-md-12">
                                <label for="full_name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="full_name" id="full_name" value="{{$detail->manager?->full_name}}" @if($form == 'Detail') disabled @endif>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" class="form-control" name="nik" id="nik" value="{{$detail->manager?->nik}}" @if($form == 'Detail') disabled @endif>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="birth_date" class="form-label">Tanggal Lahir</label>
                                <input type="text" class="form-control" name="birth_date" id="birth_date" value="{{$detail->manager?->birth_date}}" @if($form == 'Detail') disabled @endif>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email" value="{{$detail->manager?->user?->email}}" @if($form == 'Detail') disabled @endif>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="address" class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{$detail->manager?->address}}" @if($form == 'Detail') disabled @endif>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="job_code" class="form-label">Kode Pekerjaan</label>
                                <input type="text" class="form-control" name="job_code" id="job_code" value="{{$detail->manager?->job_code}}" @if($form == 'Detail') disabled @endif>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="job_title" class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control" name="job_title" id="job_title" value="{{$detail->manager?->job_title}}" @if($form == 'Detail') disabled @endif>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="organization" class="form-label">Organisasi</label>
                                <input type="text" class="form-control" name="organization" id="organization" value="{{$detail->manager?->organization}}" @if($form == 'Detail') disabled @endif>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="photo" class="form-label"></label>
                                <img src="@if($form == 'Edit' || $form == 'Detail' && $detail->manager?->user?->photo) {{ asset('photo/'.$detail->manager?->user?->photo) }} @else {{ asset('photo/default.jpg') }} @endif" class="rounded-circle" alt="" style="width: 200px;" id="load_image">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

@endsection