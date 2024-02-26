@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$title}}</h5>
                <div class="d-flex justify-content-between">
                    <a href="/tambah-karyawan" class="btn btn-primary my-2">Tambah</a>
                    <form action="" class="d-flex">
                        <input type="text" name="keyword" id="keyword" class="form-control" style="height: 38px; margin-top: 10px;" placeholder="Masukkan Keyword..." @if($keyword != null)value="{{$keyword}}"@endif>
                        <button type="submit" class="btn btn-primary ml-2" style="height: 38px; margin-top: 10px">Cari</button>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-responsive" id="datatable">
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
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>NIK</th>
                                <th>Kode Pekerjaan</th>
                                <th>Pekerjaan</th>
                                <th>Jenis Karyawan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($employeeList as $item)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$item->full_name}}</td>
                                    <td>{{$item->nik}}</td>
                                    <td>{{$item->job_code}}</td>
                                    <td>{{$item->job_title}}</td>
                                    <td>
                                        @if ($item->user->role == 'Admin IT')
                                            <span class="badge bg-primary">{{$item->user->role}}</span>
                                        @elseif($item->user->role == 'Admin Corporate')
                                            <span class="badge bg-success">{{$item->user->role}}</span>
                                        @elseif($item->user->role == 'Karyawan Senior')
                                            <span class="badge bg-danger">{{$item->user->role}}</span>
                                        @elseif($item->user->role == 'Karyawan Junior')
                                            <span class="badge bg-secondary">{{$item->user->role}}</span>
                                        @elseif($item->user->role == 'Manager')
                                            <span class="badge bg-warning">{{$item->user->role}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (Session()->get('id') == $item->id)
                                            Akun Anda
                                        @else
                                            <a href="/detail-karyawan/{{$item->id}}" class="btn btn-primary mb-1"><i class="ti ti-eye"></i></a>
                                            <a href="/edit-karyawan/{{$item->id}}" class="btn btn-success mb-1"><i class="ti ti-edit"></i></a>
                                            <button type="button" data-href="/hapus-karyawan/{{$item->id}}" data-content="Apakah Anda yakin akan non active data karyawan {{$item->full_name}} ?" class="btn btn-danger mb-1 btn-delete"><i class="ti ti-trash"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection