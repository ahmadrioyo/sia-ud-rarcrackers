@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Akun</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Akuntan</li>
                        <li class="breadcrumb-item">Data Akun</li>
                        <li class="breadcrumb-item active">Akun</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn btn-outline-info" data-toggle="modal" data-target="#modalTambahAkun"><i class="fas fa-plus"></i> Tambah Akun</a>
                    </div>
                    <div class="card-body">
                        <table id="akun" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Kode Akun</th>
                                    <th>Nama Akun</th>
                                    <th>Kelompok</th>
                                    <th>Tipe</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>[{{ $item->kode_akun }}]</td>
                                        <td>{{ $item->nama_akun }}</td>
                                        <td>{{ $item->kelompok_akuns->nama_kelompok_akun }}</td>
                                        <td>{{ $item->tipe_akuns->nama_tipe_akun }}</td>
                                        <td>
                                            <a href="" class="btn btn-info" data-toggle="modal" data-target="#modalEdit{{ $item->id }}"><i class="fas fa-edit"></i></a>
                                            <a href="" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus{{ $item->id }}"><i class="fas fa-trash"></i></a>
                                        </td>
                                        @include('akuntan.modal.editAkun', ['item' => $item, 'kelompok' => $kelompok, 'tipe' => $tipe])
                                    </tr>
                                    <div class="modal fade" id="modalHapus{{ $item->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Hapus Data Akun</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <span>Apakah anda ingin menghapus data akun <b>[{{ $item->kode_akun }}] {{ $item->nama_akun }}</b>?</span>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('akuntan.akun.delete',['id' => $item->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn bg-secondary" data-dismiss="modal">Kembali</button>
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
                </div>
            </div>
        </div>
    </div>
    @include('akuntan.modal.tambahAkun')
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#akun').DataTable({
            'searching':false
        });
    });
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
        text: "{{ $message }}",
    });
</script>
@endif
@endsection
