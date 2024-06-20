@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/summernote/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Riwayat Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Owner</a></li>
                        <li class="breadcrumb-item active">Riwayat Transaksi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                          <form action="{{ route('owner.transaksi') }}" method="GET" id="dateFilterForm">
                            <div class="form-group">
                                <label>Pilih Tanggal:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="reservation" name="date_range">
                                </div>
                            </div>
                          </form>
                        </div>
                        <div class="card-body">
                            <table id="transaksi" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Nama Transaksi</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td style="text-align: center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->tanggal->formatLocalized('%d %B %Y') }}</td>
                                        <td>{{ $item->nama_transaksi_perkiraan }}</td>
                                        <td>{{ $item->formatRupiah('jumlah') }}</td>
                                        <td style="width: 55%">{{ strip_tags(html_entity_decode($item->keterangan)) }}</td>
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
</div>
@endsection
@section('scripts')
<script src="{{ asset('dashboard/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
$(document).ready(function() {
    $('.summernote').summernote({
        height: 300,
        placeholder: 'Masukkan keterangan transaksi'
    });

    @foreach ($data as $item)
    $('#modalEdit{{ $item->id }}').on('shown.bs.modal', function() {
        $('#editKet{{ $item->id }}').summernote({
            height: 300,
            placeholder: 'Masukkan keterangan transaksi'
        });

        let jumlahInput = $('#editJumlah{{ $item->id }}');
        jumlahInput.val(formatCurrency(jumlahInput.val()));
    });

    $('#modalEdit{{ $item->id }}').on('hidden.bs.modal', function() {
        $('#editKet{{ $item->id }}').summernote('destroy');
    });

    $('#editJumlah{{ $item->id }}').on('keyup', function() {
        let value = $(this).val();
        $(this).val(formatCurrency(value));
    });
    $('#jumlahTransaksi').on('keyup', function() {
        let value = $(this).val();
        $(this).val(formatCurrency(value));
    });
    @endforeach

    var start = moment().startOf('month');
    var end = moment().endOf('month');

    @if(request('date_range'))
        var dateRange = "{{ request('date_range') }}";
        var dates = dateRange.split(' - ');
        start = moment(dates[0], 'YYYY-MM-DD');
        end = moment(dates[1], 'YYYY-MM-DD');
    @endif

    $('#reservation').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD',
            "daysOfWeek": [
                "Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"
            ],
            "monthNames": [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ],
        },
        startDate: start,
        endDate: end
    });

    $('#reservation').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        $('#dateFilterForm').submit();
    });

    $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        $('#dateFilterForm').submit();
    });

    $('#transaksi').DataTable({
        'searching': false,
    });

    function removeQueryParameters() {
        var url = window.location.href;
        var index = url.indexOf('?');
        if (index > -1) {
            window.history.pushState({}, document.title, url.substring(0, index));
        }
    }

    @if(request('date_range'))
        removeQueryParameters();
    @endif
});

function formatCurrency(value) {
    let numberString = value.replace(/[^,\d]/g, '').toString(),
        split = numberString.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    if (split[1] === undefined || split[1] === "00") {
        return rupiah;
    }

    return rupiah + ',' + split[1];
}
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
