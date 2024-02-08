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
                    <form action="@if($form == 'Tambah') /tambah-catatan @elseif($form == 'Edit') /edit-catatan/{{$detail->id_note}} @endif" method="POST" id="noteForm">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="note_title">Judul</label>
                            <input type="text" class="form-control @error('note_title') is-invalid @enderror" id="note_title" name="note_title" value="@if($form == 'Tambah'){{ old('note_title') }}@elseif($form == 'Edit' || $form == 'Detail'){{$detail->note_title}}@endif" @if($form == 'Detail') disabled @endif placeholder="Masukkan Judul" required>
                            @error('note_title')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="start">Mulai</label>
                            <input type="datetime-local" class="form-control @error('start') is-invalid @enderror" id="start" name="start" value="@if($form == 'Tambah'){{ old('start') }}@elseif($form == 'Edit' || $form == 'Detail'){{$detail->start}}@endif" @if($form == 'Detail') disabled @endif placeholder="Masukkan Mulai">
                            @error('start')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="end">Berakhir</label>
                            <input type="datetime-local" class="form-control @error('end') is-invalid @enderror" id="end" name="end" value="@if($form == 'Tambah'){{ old('end') }}@elseif($form == 'Edit' || $form == 'Detail'){{$detail->end}}@endif" @if($form == 'Detail') disabled @endif placeholder="Masukkan Berakhir">
                            @error('end')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="description">Deskripsi</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="@if($form == 'Tambah'){{ old('description') }}@elseif($form == 'Edit' || $form == 'Detail'){{$detail->description}}@endif" @if($form == 'Detail') disabled @endif placeholder="Masukkan Deskripsi" required>
                            @error('description')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="location">Lokasi</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="@if($form == 'Tambah'){{ old('location') }}@elseif($form == 'Edit' || $form == 'Detail'){{$detail->location}}@endif" @if($form == 'Detail') disabled @endif placeholder="Masukkan Lokasi" required>
                            @error('location')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    @include('components.tombolForm', ['linkKembali' => '/daftar-catatan'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection