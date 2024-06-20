@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pengguna</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Admin</a></li>
              <li class="breadcrumb-item active">Pengguna</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#modalCreate"><i class="fas fa-plus"></i> 
                        Tambah Pengguna
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="pengguna" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Pengguna</th>
                      {{-- <th>Email</th> --}}
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->user }}</td>
                            <td>{{ $d->name }}</td>
                            <td>
                                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modalEdit{{ $d->id }}"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus{{ $d->id }}"><i class="fas fa-trash"></i></a>
                            </td>
                            @include('admin.edit')
                          </tr>
                          <div class="modal fade" id="modalHapus{{ $d->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Hapus Data</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <span>Apakah anda ingin menghapus data pengguna <b>{{ $d->user }}</b></span>
                                  </div>
                                  <div class="modal-footer">
                                    <form action="{{ route('admin.user.delete',['id' => $d->id]) }}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                      <button type="submit" class="btn bg-primary">Ya, Hapus</button>
                                    </form>
                                  </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
    <!-- /.content -->
  </div>
  @include('admin.create')
  @section('scripts')
     <script>
        $(document).ready( function () {
            $('#pengguna').DataTable();
        } );
    </script> 
        
    @if($message = Session::get('failed'))
    <script>
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "{{ $message }}",
    });
    </script>
    @endif

    @if($message = Session::get('success'))
    <script>
    Swal.fire({
        icon: "success",
        // title: "Oops...",
        text: "{{ $message }}",
    });
    </script>
    @endif
  @endsection
@endsection