@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Neraca</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Owner</a></li>
                        <li class="breadcrumb-item active">Neraca</li>
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
                                    <a href="#" class="btn btn-outline-secondary align-self-center" id="print-link">
                                        <i class="fas fa-print"></i> Cetak
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="container-fluid">
                                    <table width="100%">
                                        <tr>
                                            <td style="text-align: center">
                                                <h4>Laporan Neraca</h4>
                                                <h3>UD. RAR Crackers</h3>
                                                <p>Per : <span id="period"></span></p>
                                                <p>Jalan Lawangan Daya II, Kecamatan Pademawu, Kabupaten Pamekasan</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2 style="text-align: center">Aktiva</h2>
                                        </div>
                                        <div class="card-body">
                                            <h4>Harta</h4>
                                            <div>
                                                <table class="table" id="neracakeuangan-aktiva">
                                                    <thead style="background-color: #17a2b8">
                                                        <tr style="color: white">
                                                            <th>Nama Akun</th>
                                                            <th style="text-align: right">Saldo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="aktiva-body">
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th style="text-align: left">Total Aktiva</th>
                                                            <th style="text-align: right" id="total-aktiva">Rp. 0</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2 style="text-align: center">Pasiva</h2>
                                        </div>
                                        <div class="card-body">
                                            <h4>Hutang</h4>
                                            <div>
                                                <table class="table" id="neracakeuangan-hutang">
                                                    <thead style="background-color: #17a2b8">
                                                        <tr style="color: white">
                                                            <th>Nama Akun</th>
                                                            <th style="text-align: right">Saldo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="hutang-body">
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th style="text-align: left">Total Hutang</th>
                                                            <th style="text-align: right" id="total-hutang">Rp. 0</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <h4>Modal</h4>
                                            <div>
                                                <table class="table" id="neracakeuangan-modal">
                                                    <thead style="background-color: #17a2b8">
                                                        <tr style="color: white">
                                                            <th>Nama Akun</th>
                                                            <th style="text-align: right">Saldo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="modal-body">
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th style="text-align: left">Total Modal</th>
                                                            <th style="text-align: right" id="total-modal">Rp. 0</th>
                                                        </tr>
                                                        <tr>
                                                            <th style="text-align: left">Laba Rugi</th>
                                                            <th style="text-align: right" id="laba-rugi">Rp. 0</th>
                                                        </tr>
                                                        <tr>
                                                            <th style="text-align: left">Total Pasiva</th>
                                                            <th style="text-align: right" id="total-pasiva">Rp. 0</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        var reservation = $('#reservation');
        var period = $('#period');
        var printLink = $('#print-link');

        reservation.daterangepicker({
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

        reservation.on('apply.daterangepicker', function(ev, picker) {
            var startDate = picker.startDate.format('YYYY-MM-DD');
            var endDate = picker.endDate.format('YYYY-MM-DD');
            fetchNeracaKeuangan(startDate, endDate);
        });

        function fetchNeracaKeuangan(start_date, end_date) {
            $.ajax({
                url: '{{ route("owner.neraca-keuangan") }}',
                method: 'GET',
                data: {
                    start_date: start_date,
                    end_date: end_date
                },
                success: function(response) {
                    renderNeracaKeuangan(response);
                    period.text(response.period);

                    printLink.attr('href', `{{ route('owner.neraca-keuangan') }}?export=pdf&start_date=${start_date}&end_date=${end_date}`);
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        }

        function renderNeracaKeuangan(data) {
            var { groupedData, totalPerAkun, totalAktiva, totalHutang, totalModal, labaRugi, totalPasiva } = data;

            let aktivaHtml = '';
            let hutangHtml = '';
            let modalHtml = '';
            let totalModalCalculated = 0;

            for (let akun in groupedData) {
                var data = groupedData[akun];
                var saldo = totalPerAkun[data.nama_akun].toLocaleString('id-ID');

                if (data.kelompok === 'Harta') {
                    aktivaHtml += `<tr>
                        <td>${data.nama_akun}</td>
                        <td style="text-align: right">Rp. ${saldo}</td>
                    </tr>`;
                } else if (data.kelompok === 'Hutang') {
                    hutangHtml += `<tr>
                        <td>${data.nama_akun}</td>
                        <td style="text-align: right">Rp. ${saldo}</td>
                    </tr>`;
                } else if (data.kelompok === 'Modal') {
                    modalHtml += `<tr>
                        <td>${data.nama_akun}</td>
                        <td style="text-align: right">Rp. ${saldo}</td>
                    </tr>`;
                    totalModalCalculated += totalPerAkun[data.nama_akun];
                }
            }

            $('#aktiva-body').html(aktivaHtml);
            $('#hutang-body').html(hutangHtml);
            $('#modal-body').html(modalHtml);
            $('#total-aktiva').text(`Rp. ${totalAktiva.toLocaleString('id-ID')}`);
            $('#total-hutang').text(`Rp. ${totalHutang.toLocaleString('id-ID')}`);
            $('#total-modal').text(`Rp. ${totalModalCalculated.toLocaleString('id-ID')}`);
            $('#laba-rugi').text(`Rp. ${labaRugi.toLocaleString('id-ID')}`);
            $('#total-pasiva').text(`Rp. ${totalPasiva.toLocaleString('id-ID')}`);
        }

        var startDate = moment().startOf('month').format('YYYY-MM-DD');
        var endDate = moment().endOf('month').format('YYYY-MM-DD');
        fetchNeracaKeuangan(startDate, endDate);
    });
</script>
@endsection