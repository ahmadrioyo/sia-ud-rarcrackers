@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Owner</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="content">
          <div class="conteiner-fluid">
            <div class="card">
              <div class="card-header">
                <h5 class="mb-2">Menu</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h3>Riwayat Transaksi</h3>
    
                        <p>Pencatatan semua kegiatan transaksi</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-handshake"></i>
                      </div>
                      <a href="{{ route('owner.transaksi') }}" class="small-box-footer">Selengkapnya  <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h3>Jurnal</h3>
    
                        <p>Pencatatan jurnal dari hasil transaksi</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-window-restore"></i>
                      </div>
                      <a href="{{ route('owner.jurnal') }}" class="small-box-footer">Selengkapnya  <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                      <div class="inner">
                        <h3>Buku Besar</h3>
    
                        <p>Pembukuan tiap tiap akun</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-book"></i>
                      </div>
                      <a href="{{ route('owner.buku-besar') }}" class="small-box-footer">Selengkapnya  <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <!-- ./col -->
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h5 class="mb-2">Laporan Keuangan</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                      <a href="{{ route('owner.laba-rugi') }}" class="info-box-icon bg-info"><i class="fas fa-percentage"></i></a>
        
                      <div class="info-box-content">
                        <span class="info-box-text">Laporan</span>
                        <span class="info-box-number">Laba Rugi</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                      <a href="{{ route('owner.perubahan-modal') }}" class="info-box-icon bg-success"><i class="fas fa-sync-alt"></i></a>
        
                      <div class="info-box-content">
                        <span class="info-box-text">Laporan</span>
                        <span class="info-box-number">Perubahan Modal</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                      <a href="{{ route('owner.arus-kas') }}" class="info-box-icon bg-secondary"><i class="fas fa-money-bill"></i></a>
        
                      <div class="info-box-content">
                        <span class="info-box-text">Laporan</span>
                        <span class="info-box-number">Arus Kas</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                      <a href="{{ route('owner.neraca-keuangan') }}" class="info-box-icon bg-danger"><i class="fas fa-balance-scale"></i></a>
        
                      <div class="info-box-content">
                        <span class="info-box-text">Laporan</span>
                        <span class="info-box-number">Neraca Keuangan</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                </div>
              </div>
            </div>
            {{-- <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header border-0">
                      <div class="d-flex justify-content-between">
                        <h3 class="card-title">Laba Rugi</h3>
                        <a href="{{ route('owner.laba-rugi') }}">View Report</a>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="d-flex">
                        <p class="d-flex flex-column">
                          <span class="text-bold text-lg">$18,230.00</span>
                          <span>Pendapatan Secara Keseluruhan</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                          <span class="text-success">
                            <i class="fas fa-arrow-up"></i> 33.1%
                          </span>
                          <span class="text-muted">Satu Bulan Terakhir</span>
                        </p>
                      </div>
                      <!-- /.d-flex -->

                      <div class="position-relative mb-4">
                        <canvas id="sales-chart" height="200"></canvas>
                      </div>

                      <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                          <i class="fas fa-square text-primary"></i> This year
                        </span>

                        <span>
                          <i class="fas fa-square text-gray"></i> Last year
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
            </div> --}}
          </div>
        </div>
    </div>
@endsection
@section('scripts')
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