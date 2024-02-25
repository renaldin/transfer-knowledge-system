@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$title}}</h5>
                <a href="/tambah-pengguna" class="btn bg-primary my-2">Tambah</a>
                <div class="table-responsive">
                    <table class="table datatable table-responsive" id="datatable">
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
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection