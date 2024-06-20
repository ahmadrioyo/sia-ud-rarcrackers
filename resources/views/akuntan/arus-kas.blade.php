@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Arus Kas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Akuntan</a></li>
                            <li class="breadcrumb-item active">Arus Kas</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="form-group mb-0">
                                    <label>Pilih Periode:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="reservation">
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('akuntan.arus-kas', ['export' => 'pdf']) }}" class="btn btn-outline-secondary align-self-center" id="print-link">
                                            <i class="fas fa-print"></i> Cetak
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                  <table width="100%">
                                    <tr>
                                        <td style="text-align: center">
                                            <h4>Arus Kas</h4>
                                            <h3>UD. RAR Crackers</h3>
                                            <p>Per :  <span id="period"></span></p>
                                            <p>Jalan Lawangan Daya II, Kecamatan Pademawu, Kabupaten Pamekasan</p>
                                        </td>
                                    </tr>
                                  </table>
                                </div>
                                <table id="aruskas" class="table table-bordered">
                                    <thead style="background-color: #17a2b8">
                                        <tr style="color: white">
                                            <th>Arus Kas</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="2">Arus Kas dari Aktivitas Operasional</th>
                                        </tr>
                                        <tr>
                                            <td>Laba Rugi</td>
                                            <td>{{ $data['arusKasOperasional'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Hutang</td>
                                            <td>({{ $data['hutang'] }})</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Arus Kas dari Aktivitas Pendanaan</th>
                                        </tr>
                                        <tr>
                                            <td>Saldo Awal</td>
                                            <td>{{ $data['saldoAwalKas'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Modal Tambahan</td>
                                            <td>{{ $data['modalTambahan'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Prive</td>
                                            <td>({{ $data['penguranganModal'] }})</td>
                                        </tr>
                                        <tr>
                                            <th>Saldo Akhir Kas</th>
                                            <th>{{ $data['saldoAkhirKas'] }}</th>
                                        </tr>
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
<script>
    $(function () {
        var period = $('#period');
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

            $.ajax({
                url: '{{ route("akuntan.arus-kas") }}',
                type: "GET",
                data: {
                    start_date: startDate,
                    end_date: endDate,
                },
                success: function(response) {
                    var data = response.data;

                    var tbodyHtml = `
                        <tr>
                            <th colspan="2">Arus Kas dari Aktivitas Operasional</th>
                        </tr>
                        <tr>
                            <td>Laba Rugi</td>
                            <td>${data.arusKasOperasional}</td>
                        </tr>
                        <tr>
                            <td>Hutang</td>
                            <td>(${data.hutang})</td>
                        </tr>
                        <tr>
                            <th colspan="2">Arus Kas dari Aktivitas Pendanaan</th>
                        </tr>
                        <tr>
                            <td>Saldo Awal</td>
                            <td>${data.saldoAwalKas}</td>
                        </tr>
                        <tr>
                            <td>Modal Tambahan</td>
                            <td>${data.modalTambahan}</td>
                        </tr>
                        <tr>
                            <td>Prive</td>
                            <td>(${data.penguranganModal})</td>
                        </tr>
                        <tr>
                            <th>Saldo Akhir Kas</th>
                            <th>${data.saldoAkhirKas}</th>
                        </tr>
                    `;
                    $('#aruskas tbody').html(tbodyHtml);
                    period.text(response.period);
                    $('#print-link').attr('href', '{{ route("akuntan.arus-kas") }}' + '?export=pdf&start_date=' + startDate + '&end_date=' + endDate);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
