@extends('layouts.main')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Buku Besar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Akuntan</a></li>
                        <li class="breadcrumb-item active">Buku Besar</li>
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
                            <div class="form-group">
                                <label class="mt-1" for="reservation">Pilih Periode:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="reservation">
                                </div>
                                <label class="mt-3" for="">Pilih Akun:</label>
                                <div class="input-group">                           
                                    <select class="form-control" name="selected_account" id="selected_account">
                                        <option selected disabled>Semua Akun</option>
                                        @foreach ($groupedData as $group => $entries)                                        
                                            <option value="{{ $group }}">{{ $group }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('akuntan.buku-besar', ['export' => 'pdf']) }}" id="print-link" class="btn btn-outline-secondary align-self-center">
                                    <i class="fas fa-print"></i> Cetak
                                </a>
                            </div>
                        </div>
                        <div class="card-body" id="buku-besar-container">
                            @include('akuntan.table.buku-besar')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(document).ready(function() {
        $('#reservation').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD',
                daysOfWeek: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
                monthNames: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            },
            startDate: moment().startOf('month'),
            endDate: moment().endOf('month')
        });

        $('#reservation').on('apply.daterangepicker', function(ev, picker) {
            var startDate = picker.startDate.format('YYYY-MM-DD');
            var endDate = picker.endDate.format('YYYY-MM-DD');

            updateBukuBesar(startDate, endDate, $('#selected_account').val());
        });

        $('#selected_account').change(function() {
            var selectedAccount = $(this).val();

            updateBukuBesar(
                $('#reservation').data('daterangepicker').startDate.format('YYYY-MM-DD'),
                $('#reservation').data('daterangepicker').endDate.format('YYYY-MM-DD'),        
                selectedAccount);
        });
    });

    function updateBukuBesar(startDate, endDate, selectedAccount = null) {
        $.ajax({
            url: '{{ route("akuntan.buku-besar") }}',
            type: 'GET',
            data: {
                start_date: startDate,
                end_date: endDate,
                selected_account: selectedAccount
            },
            success: function(response) {
                console.log(response);
                $('#buku-besar-container').html(response);
                var startPeriod = moment(startDate).format('MMMM YYYY');
                var period = startPeriod ? startPeriod : startPeriod;
                $('#print-link').attr('href', '{{ route("akuntan.buku-besar") }}' + '?export=pdf&start_date=' + startDate + '&end_date=' + endDate + (selectedAccount ? '&selected_account=' + selectedAccount : ''));
                $('p:contains("Per :")').text('Per : ' + period);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>
@endsection