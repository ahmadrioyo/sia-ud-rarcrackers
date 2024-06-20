@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laba Rugi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Akuntan</a></li>
                        <li class="breadcrumb-item active">Laporan Laba Rugi</li>
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
                                <label for="reservation">Pilih Periode:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="reservation">
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('akuntan.laba-rugi', ['export' => 'pdf']) }}" id="print-link" class="btn btn-outline-secondary align-self-center">
                                    <i class="fas fa-print"></i> Cetak
                                </a>
                            </div>
                        </div>
                        <div class="card-body" id="laba-rugi-container">
                            @include('akuntan.table.laba-rugi')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#reservation').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD',
                daysOfWeek: [
                    "Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"
                ],
                monthNames: [
                    "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ],
            },
            startDate: moment().startOf('month'),
            endDate: moment().endOf('month')
        });

        $('#reservation').on('apply.daterangepicker', function(ev, picker) {
            var startDate = picker.startDate.format('YYYY-MM-DD');
            var endDate = picker.endDate.format('YYYY-MM-DD');
            // var url = '{{ route("akuntan.laba-rugi") }}';
            // console.log(startDate);
            // console.log(endDate);
            $.ajax({
                url: '{{ route("akuntan.laba-rugi") }}',
                type: 'GET',
                data: {
                    start_date: startDate,
                    end_date: endDate
                },
                success: function(response) {
                    $('#laba-rugi-container').html(response);
                    var startPeriod = moment(startDate).format('MMMM YYYY');
                    var period = startPeriod ? startPeriod : startPeriod;
                    $('#print-link').attr('href', '{{ route("akuntan.laba-rugi") }}' + '?export=pdf&start_date=' + startDate + '&end_date=' + endDate);
                    $('p:contains("Per :")').text('Per : ' + period);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection