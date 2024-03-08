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
                <form action="@if($form == 'Tambah') /tambah-kaderisasi @elseif($form == 'Edit') /edit-kaderisasi/{{$detail->id}} @endif" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="junior_employee_id" class="form-label">Karyawan Junior <small class="text-danger">*</small></label>
                            <select name="junior_employee_id" id="junior_employee_id" class="form-control" @if($form == 'Detail' || $form == 'Edit') disabled @endif required>
                                <option value="" disabled selected>-- Pilih --</option>
                                @foreach ($juniorEmployee as $item)
                                    <option value="{{$item->id}}" @if($form == 'Edit' && $detail->junior_employee_id == $item->id) selected @elseif($form == 'Detail' && $detail->junior_employee_id == $item->id) selected @endif>{{ $item->full_name }} | {{ $item->job_title }}</option>
                                @endforeach
                            </select>
                            @error('junior_employee_id')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="senior_employee_id" class="form-label">Karyawan Senior <small class="text-danger">*</small></label>
                            <select name="senior_employee_id" id="senior_employee_id" class="form-control" @if($form == 'Detail' || $form == 'Edit') disabled @endif required>
                                <option value="" disabled selected>-- Pilih --</option>
                                @foreach ($seniorEmployee as $item)
                                    <option value="{{$item->id}}" @if($form == 'Edit' && $detail->senior_employee_id == $item->id) selected @elseif($form == 'Detail' && $detail->senior_employee_id == $item->id) selected @endif>{{ $item->full_name }} | {{ $item->job_title }}</option>
                                @endforeach
                            </select>
                            @error('senior_employee_id')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="manager_id" class="form-label">Manager <small class="text-danger">*</small></label>
                            <select name="manager_id" id="manager_id" class="form-control" @if($form == 'Detail') disabled @endif required>
                                <option value="" disabled selected>-- Pilih --</option>
                                @foreach ($manager as $item)
                                    <option value="{{$item->id}}" @if($form == 'Edit' && $detail->manager_id == $item->id) selected @elseif($form == 'Detail' && $detail->manager_id == $item->id) selected @endif>{{ $item->full_name }} | {{ $item->job_title }}</option>
                                @endforeach
                            </select>
                            @error('manager_id')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="descirpiton" class="form-label">Uraian Keilmuan <small class="text-danger">*</small></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="15" rows="5" @if($form == 'Detail') disabled @endif placeholder="Masukkan Uraian Keilmuan...">@if($form == 'Edit' || $form == 'Detail') {{$detail->description}} @endif</textarea>
                            @error('description')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 text-center mt-4">
                            @if ($form == 'Detail')
                                <a href="/data-kaderisasi" class="btn btn-light">Kembali</a>
                            @else
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="/data-kaderisasi" class="btn btn-light">Kembali</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection