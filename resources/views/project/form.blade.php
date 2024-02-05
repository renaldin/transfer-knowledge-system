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
                    <form action="@if($form == 'Tambah') /tambah-proyek @elseif($form == 'Edit') /edit-proyek/{{$detail->id_project}} @endif" method="POST" id="projectForm">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="id_user">Klien</label>
                            <select name="id_user" id="id_user" class="selectpicker form-control @error('id_user') is-invalid @enderror" data-live-search="true" @if($form == 'Detail') disabled @endif required>
                                <option value="" selected disabled>-- Pilih --</option>
                                @foreach ($klienList as $item)
                                    <option value="{{$item->id_user}}" @if($form == 'Edit' && $detail->id_user == $item->id_user) selected @elseif($form == 'Detail' && $detail->id_user == $item->id_user) selected @endif >{{$item->fullname}}</option>
                                @endforeach
                            </select>
                            @error('id_user')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="project_title">Judul Proyek</label>
                            <input type="text" class="form-control @error('project_title') is-invalid @enderror" id="project_title" name="project_title" value="@if($form == 'Tambah'){{ old('project_title') }}@elseif($form == 'Edit' || $form == 'Detail'){{$detail->project_title}}@endif" @if($form == 'Detail') disabled @endif placeholder="Masukkan Judul Proyek" required>
                            @error('project_title')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="start_date">Tanggal Mulai</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="@if($form == 'Tambah'){{ old('start_date') }}@elseif($form == 'Edit' || $form == 'Detail'){{$detail->start_date}}@endif" @if($form == 'Detail') disabled @endif placeholder="Masukkan Tanggal Mulai">
                            @error('start_date')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="deadline">Deadline</label>
                            <input type="date" class="form-control @error('deadline') is-invalid @enderror" id="deadline" name="deadline" value="@if($form == 'Tambah'){{ old('deadline') }}@elseif($form == 'Edit' || $form == 'Detail'){{$detail->deadline}}@endif" @if($form == 'Detail') disabled @endif placeholder="Masukkan Deadline">
                            @error('deadline')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="dp">DP</label>
                            <input type="text" class="form-control @error('dp') is-invalid @enderror" id="dp" name="dp" value="@if($form == 'Tambah'){{ old('dp') }}@elseif($form == 'Edit' || $form == 'Detail'){{$detail->dp}}@endif" @if($form == 'Detail') disabled @endif placeholder="Masukkan DP" required>
                            @error('dp')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="project_type">Jenis Proyek</label>
                            <select name="project_type" id="project_type" class="selectpicker form-control @error('project_type') is-invalid @enderror" data-live-search="true" @if($form == 'Detail') disabled @endif>
                                <option value="" selected disabled>-- Pilih --</option>
                                <option value="Website" @if($form == "Tambah" && old("project_type") == "Website") selected @elseif($form == "Edit" && $detail->project_type == "Website") selected @elseif($form == "Detail" && $detail->project_type == "Website") selected @endif>Website</option>
                                <option value="Mobile" @if($form == "Tambah" && old("project_type") == "Mobile") selected @elseif($form == "Edit" && $detail->project_type == "Mobile") selected  @elseif($form == "Detail" && $detail->project_type == "Mobile") selected @endif>Mobile</option>
                            </select>
                            @error('project_type')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="project_status">Status Proyek</label>
                            <select name="project_status" id="project_status" class="selectpicker form-control @error('project_status') is-invalid @enderror" data-live-search="true" @if($form == 'Detail') disabled @endif>
                                <option value="" selected disabled>-- Pilih --</option>
                                <option value="Belum Mulai" @if($form == "Tambah" && old("project_status") == "Belum Mulai") selected @elseif($form == "Edit" && $detail->project_status == "Belum Mulai") selected @elseif($form == "Detail" && $detail->project_status == "Belum Mulai") selected @endif>Belum Mulai</option>
                                <option value="Proses" @if($form == "Tambah" && old("project_status") == "Proses") selected @elseif($form == "Edit" && $detail->project_status == "Proses") selected @elseif($form == "Detail" && $detail->project_status == "Proses") selected @endif>Proses</option>
                                <option value="Selesai" @if($form == "Tambah" && old("project_status") == "Selesai") selected @elseif($form == "Edit" && $detail->project_status == "Selesai") selected @elseif($form == "Detail" && $detail->project_status == "Selesai") selected @endif>Selesai</option>
                            </select>
                            @error('project_status')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="document_status">Status Dokumen Proyek</label>
                            <select name="document_status" id="document_status" class="selectpicker form-control @error('document_status') is-invalid @enderror" data-live-search="true" @if($form == 'Detail') disabled @endif>
                                <option value="" selected disabled>-- Pilih --</option>
                                <option value="Belum" @if($form == "Tambah" && old("document_status") == "Belum") selected @elseif($form == "Edit" && $detail->document_status == "Belum") selected @elseif($form == "Detail" && $detail->document_status == "Belum") selected @endif>Belum</option>
                                <option value="Sudah" @if($form == "Tambah" && old("document_status") == "Sudah") selected @elseif($form == "Edit" && $detail->document_status == "Sudah") selected @elseif($form == "Detail" && $detail->document_status == "Sudah") selected @endif>Sudah</option>
                            </select>
                            @error('document_status')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="project_note">Catatan Proyek</label>
                            <textarea class="form-control @error('project_note') is-invalid @enderror" name="project_note" id="project_note" cols="15" rows="5" placeholder="Masukkan Catatan" @if($form == 'Detail') disabled @endif>@if($form == 'Tambah'){{ old('project_note') }}@elseif($form == 'Edit' || $form == 'Detail'){{$detail->project_note}}@endif</textarea>
                            @error('project_note')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    @include('components.tombolForm', ['linkKembali' => '/daftar-proyek'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection