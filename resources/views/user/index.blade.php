@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$subTitle}}</h5>
                <div class="d-flex justify-content-between">
                    <a href="/tambah-pengguna" class="btn btn-primary my-2">Tambah</a>
                    <form action="" class="d-flex">
                        <input type="text" name="keyword" id="keyword" class="form-control" style="height: 38px; margin-top: 10px;" placeholder="Masukkan Keyword..." @if($keyword != null)value="{{$keyword}}"@endif>
                        <button type="submit" class="btn btn-primary ml-2" style="height: 38px; margin-top: 10px">Cari</button>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-responsive" id="datatable">
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
                            <tr style="background-color: #eaeff4">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Userrname</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($daftarUser as $item)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->username}}</td>
                                    <td>
                                        @if ($item->role == 'Admin IT')
                                            <span class="badge bg-primary">{{$item->role}}</span>
                                        @elseif($item->role == 'Admin Corporate')
                                            <span class="badge bg-success">{{$item->role}}</span>
                                        @elseif($item->role == 'Karyawan Senior')
                                            <span class="badge bg-danger">{{$item->role}}</span>
                                        @elseif($item->role == 'Karyawan Junior')
                                            <span class="badge bg-secondary">{{$item->role}}</span>
                                        @elseif($item->role == 'Manager')
                                            <span class="badge bg-warning">{{$item->role}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (Session()->get('id') == $item->id)
                                            Akun Anda
                                        @else
                                            <a href="/detail-pengguna/{{$item->id}}" class="btn btn-primary mb-1"><i class="ti ti-eye"></i></a>
                                            <a href="/edit-pengguna/{{$item->id}}" class="btn btn-success mb-1"><i class="ti ti-edit"></i></a>
                                            {{-- <button type="button" data-href="/hapus-pengguna/{{$item->id}}" data-content="Apakah Anda yakin akan non active data pengguna {{$item->name}} ?" class="btn btn-danger mb-1 btn-delete"><i class="ti ti-trash"></i></button> --}}
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