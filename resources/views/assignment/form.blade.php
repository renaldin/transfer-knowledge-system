@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">{{$subTitle}}</div>
            </div>
            <div class="card-body">
                @if (Session('success'))
                    <div class="alert bg-primary text-white" role="alert">
                        {{Session('success')}}
                    </div>
                @endif
                @if (Session('failed'))
                    <div class="alert bg-danger text-white" role="alert">
                        {{Session('failed')}}
                    </div>
                @endif
                <form action="@if($form == 'Tambah') /tambah-penugasan @elseif($form == 'Edit') /edit-penugasan/{{$detail->id}} @endif" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="cadre_development_id" class="form-label">Kaderisasi <small class="text-danger">*</small></label>
                            <select name="cadre_development_id" id="cadre_development_id" class="form-control" @if($form == 'Detail' || $form == 'Edit') disabled @endif required>
                                <option value="" disabled selected>-- Pilih --</option>
                                @foreach ($cadreDevelopment as $item)
                                    <option value="{{$item->id}}" @if($form == 'Edit' && $detail->cadre_development_id == $item->id) selected @elseif($form == 'Detail' && $detail->cadre_development_id == $item->id) selected @endif>Senior: {{ $item->seniorEmployee->full_name }} | Junior: {{ $item->juniorEmployee->full_name }}</option>
                                @endforeach
                            </select>
                            @error('cadre_development_id')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="task" class="form-label">Tugas <small class="text-danger">*</small></label>
                            <input type="text" class="form-control @error('task') is-invalid @enderror" name="task" id="task" @if($form == 'Tambah') value="{{old('task')}}" @elseif($form == 'Edit' || $form == 'Detail') value="{{$detail->task}}" @endif @if($form == 'Detail') disabled @endif placeholder="Masukkan Tugas...">
                            @error('task')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="start_date" class="form-label">Tanggal Mulai <small class="text-danger">*</small></label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date" @if($form == 'Tambah') value="{{old('start_date')}}" @elseif($form == 'Edit' || $form == 'Detail') value="{{$detail->start_date}}" @endif @if($form == 'Detail') disabled @endif placeholder="Masukkan Tanggal Mulai...">
                            @error('start_date')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="last_date" class="form-label">Tanggal Akhir <small class="text-danger">*</small></label>
                            <input type="date" class="form-control @error('last_date') is-invalid @enderror" name="last_date" id="last_date" @if($form == 'Tambah') value="{{old('last_date')}}" @elseif($form == 'Edit' || $form == 'Detail') value="{{$detail->last_date}}" @endif @if($form == 'Detail') disabled @endif placeholder="Masukkan Tanggal Akhir...">
                            @error('last_date')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="descirpiton" class="form-label">Uraian Penugasan <small class="text-danger">*</small></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="15" rows="5" @if($form == 'Detail') disabled @endif placeholder="Masukkan Uraian Penugasan...">@if($form == 'Edit' || $form == 'Detail') {{$detail->description}} @endif</textarea>
                            @error('description')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 text-center mt-4">
                            @if ($form == 'Detail')
                                <a href="/data-penugasan" class="btn btn-light">Kembali</a>
                            @else
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="/data-penugasan" class="btn btn-light">Kembali</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection