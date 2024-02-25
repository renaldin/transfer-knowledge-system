
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{$subTitle ? $subTitle : $title}} | STL</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('template/src/assets/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('template/src/assets/css/styles.min.css') }}" />
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.5.0/css/rowReorder.bootstrap.css"> --}}
  <style>
    .page-wrapper {
        position: relative;
    }

    .radial-gradient {
        position: absolute; 
        top: 0;
        left: 0;
        width: 100%; 
        height: 100%;
    }
  </style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper radial-gradient" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('layout.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('layout.navbar')
      <!--  Header End -->
      <div class="container-fluid">
        <div class="card">
          <div class="card-body d-flex justify-content-between">
            <h5 class="card-title fw-semibold">{{$title}}</h5>
            <span>{{$title}} / {{$subTitle}}</span>
          </div>
        </div>
        @yield('content')
      </div>
    </div>
  </div>

  {{-- Modal Logut --}}
  <div class="modal fade" id="logout" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Logout</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin akan logout ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
          <a href="/logout" class="btn btn-danger">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('template/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('template/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template/src/assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('template/src/assets/js/app.min.js') }}"></script>
  <script src="{{ asset('template/src/assets/libs/simplebar/dist/simplebar.js') }}"></script>
  {{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap.js"></script>
  <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.js"></script>
  <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/rowReorder.bootstrap.js"></script> --}}
  <script src="{{ asset('js/script.js') }}"></script>
  <script>
    new DataTable('#datatable', {
        rowReorder: true
    });
  </script>
  {{-- <script type="text/javascript">
    $(function () {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('pengguna-json') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'username', name: 'username'},
                {data: 'role', name: 'role'},
            ]
        })
    })
  </script> --}}
</body>

</html>