@extends('layout.main')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$title}}</h5>
                    <a href="/tambah-pengguna" class="btn btn-primary my-2">Tambah</a>
                    <div class="table-responsive">
                        <table class="table datatable table-responsive">
                            @if (session('success'))
                                <div class="alert alert-primary bg-primary text-light border-0 alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-primary bg-primary text-light border-0 alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <thead>
                                <tr>
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
                                            @if ($item->role == 'Pelamar')
                                                <span class="badge bg-primary">{{$item->role}}</span>
                                            @elseif($item->role == 'HRD')
                                                <span class="badge bg-success">{{$item->role}}</span>
                                            @elseif($item->role == 'Manager')
                                                <span class="badge bg-danger">{{$item->role}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (Session()->get('id') == $item->id)
                                                Akun Anda
                                            @else
                                                <a href="/detail-pengguna/{{$item->id}}" class="btn btn-primary"><i class="bi bi-justify"></i></a>
                                                <a href="/edit-pengguna/{{$item->id}}" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                                <button type="button" data-href="/hapus-pengguna/{{$item->id}}" data-content="Apakah Anda yakin akan hapus data pengguna {{$item->name}} ?" class="btn btn-danger btn-delete"><i class="bi bi-trash"></i></button>
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
</section>
@endsection