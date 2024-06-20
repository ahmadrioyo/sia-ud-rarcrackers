@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Perubahan Modal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Akuntan</a></li>
                        <li class="breadcrumb-item active">Perubahan Modal</li>
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
                            <div class="form-group">
                                <label>Pilih Periode:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="reservation" name="daterange">
                                </div>
                            </div>
                            <a href="{{ route('akuntan.perubahan-modal', ['export' => 'pdf']) }}" id="print-link" class="btn btn-outline-secondary">
                                <i class="fas fa-print"></i> Cetak
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <table width="100%">
                                    <tr>
                                        <td style="text-align: center">
                                            <h4>Perubahan Modal</h4>
                                            <h3>UD. RAR Crackers</h3>
                                            <p>Per : <span id="period"></span></p>
                                            <p>Jalan Lawangan Daya II, Kecamatan Pademawu, Kabupaten Pamekasan</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <table id="perubahanmodal" class="table table-bordered">
                                <thead style="background-color: #17a2b8">
                                    <tr style="color: white">
                                        <th>Uraian</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Modal Awal</td>
                                        <td>{{ $data['modal_awal'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Modal Tambahan</td>
                                        <td>{{ $data['modal_tambahan'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Laba/Rugi</td>
                                        <td>{{ $data['laba_rugi'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pengurangan Modal</td>
                                        <td>({{ $data['pengurangan_modal'] }})</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Modal Akhir</th>
                                        <td><strong>{{ $data['modal_akhir'] }}</strong></td>
                                    </tr>
                                </tfoot>
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
    $(function() {
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
                url: '{{ route("akuntan.perubahan-modal") }}',
                type: "GET",
                data: {
                    start_date: startDate,
                    end_date: endDate,
                },
                success: function(response) {
                    console.log(response);

                    var modalData = response.data;

                    var tbodyHtml = `
                        <tr>
                            <td>Modal Awal</td>
                            <td>${modalData.modal_awal}</td>
                        </tr>
                        <tr>
                            <td>Modal Tambahan</td>
                            <td>${modalData.modal_tambahan}</td>
                        </tr>
                        <tr>
                            <td>Laba/Rugi</td>
                            <td>${modalData.laba_rugi}</td>
                        </tr>
                        <tr>
                            <td>Pengurangan Modal</td>
                            <td>(${modalData.pengurangan_modal})</td>
                        </tr>
                    `;
                    $('#perubahanmodal tbody').html(tbodyHtml);

                    var tfootHtml = `
                        <tr>
                            <th>Modal Akhir</th>
                            <td>${modalData.modal_akhir}</td>
                        </tr>
                    `;
                    $('#perubahanmodal tfoot').html(tfootHtml);
                    period.text(response.period);

                    $('#print-link').attr('href', '{{ route("akuntan.perubahan-modal") }}' + '?export=pdf&start_date=' + startDate + '&end_date=' + endDate);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
