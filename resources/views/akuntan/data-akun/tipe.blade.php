@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0">Tipe Akun</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Akuntan</a></li>
                    <li class="breadcrumb-item">Data Akun</a></li>
                    <li class="breadcrumb-item active">Tipe Akun</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        <div class="row">
            <div class="col">
                <div class="card">
                <div class="card-header">
                    <a href="#" class="btn btn-outline-info" data-toggle="modal" data-target="#modalTambahTipe"><i class="fas fa-plus"></i> 
                        Tambah Tipe Akun
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tipe" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Kode Tipe Akun</th>
                        <th>Nama Tipe Akun</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->kode_tipe_akun }}</td>
                                <td>{{ $d->nama_tipe_akun }}</td>
                                <td>
                                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#modalEdit{{ $d->id }}"><i class="fas fa-edit"></i></a>
                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus{{ $d->id }}"><i class="fas fa-trash"></i></a>
                                </td>
                            @include('akuntan.modal.editTipe')
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
                                        <span>Apakah anda ingin menghapus data tipe akun <b>{{ $d->nama_tipe_akun }}</b></span>
                                      </div>
                                      <div class="modal-footer">
                                        <form action="{{ route('akuntan.tipe.delete',['id' => $d->id]) }}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <button type="button" class="btn bg-secondary" data-bs-dismiss="modal">Kembali</button>
                                          <button type="submit" class="btn bg-primary">Ya, Hapus</button>
                                        </form>
                                      </div>
                                  </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- /.card -->
            </div>
        </div>
    </div>
    @include('akuntan.modal.tambahTipe')
    @section('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

        <script>
            $(document).ready( function () {
                $('#tipe').DataTable({
                  'searching' : false,  
                });
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