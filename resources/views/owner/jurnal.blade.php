@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jurnal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Owner</a></li>
                        <li class="breadcrumb-item active">Jurnal</li>
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
                                    <input type="text" class="form-control float-right" id="reservation">
                                </div>
                            </div>
                            <a href="{{ route('owner.jurnal') }}?export=pdf" class="btn btn-outline-secondary" id="print-link">
                                <i class="fas fa-print"></i> Cetak
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <table width="100%">
                                    <tr>
                                        <td style="text-align: center">
                                            <h4>Jurnal Umum</h4>
                                            <h3>UD. RAR Crackers</h3>
                                            <p>Per : {{ $period }}</p>
                                            <p>Jalan Lawangan Daya II, Kecamatan Pademawu, Kabupaten Pamekasan</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <table id="jurnal" class="table table-bordered table-striped">
                                <thead style="background-color: #17a2b8">
                                    <tr style="color: white">
                                        <th>Tanggal</th>
                                        <th>Akun</th>
                                        <th>Keterangan</th>
                                        <th>Kode Akun</th>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $lastDate = null; @endphp
                                    @foreach ($data as $jurnal)
                                        @foreach ($jurnal->detail_jurnal as $detail)
                                            <tr>
                                                <td>
                                                    @if ($lastDate !== $jurnal->tanggal->formatLocalized('%d %B'))
                                                        {{ $jurnal->tanggal->formatLocalized('%d %B') }}
                                                        @php $lastDate = $jurnal->tanggal->formatLocalized('%d %B'); @endphp
                                                    @endif
                                                </td>
                                                <td>{{ $detail->akun->nama_akun }}</td>
                                                <td>{{ $detail->transaksi->nama_transaksi_perkiraan }}</td>
                                                <td>[{{ $detail->akun->kode_akun }}]</td>
                                                <td>{{ $detail->debit }}</td>
                                                <td>{{ $detail->kredit }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">Total</th>
                                        <th>Rp. {{ number_format($totalDebit, 0, ',', '.') }}</th>
                                        <th>Rp. {{ number_format($totalKredit, 0, ',', '.') }}</th>
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
        $(document).ready(function() {
            var table = $('#jurnal').DataTable({
                'searching': false,
                "paging": false,
                "ordering": false,
                "columnDefs": [
                    { type: 'date-eu', targets: 0 },
                    {
                        "render": function(data, type, row) {
                            return 'Rp. ' + new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(data);
                        },
                        "targets": [4, 5]
                    }
                ]
            });

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

                $.ajax({
                    url: '{{ route("owner.jurnal.search") }}',
                    type: 'GET',
                    data: {
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function(response) {
                        table.clear().draw();
                        var lastDate = '';
                        var totalDebit = 0;
                        var totalKredit = 0;

                        response.forEach(function(item) {
                            item.detail_jurnal.forEach(function(detail) {
                                var formattedDate = moment(item.tanggal).format('DD MMMM');
                                var displayDate = lastDate !== formattedDate ? formattedDate : '';
                                lastDate = formattedDate;

                                var rowNode = table.row.add([
                                    displayDate,
                                    detail.akun.nama_akun,
                                    detail.transaksi.nama_transaksi_perkiraan,
                                    '[' + detail.akun.kode_akun + ']',
                                    detail.debit,
                                    detail.kredit,
                                    `<a href="{{ url('edit/jurnal/${item.id}') }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus${item.id}"><i class="fas fa-trash"></i></a>`
                                ]).draw(false).node();

                                $(rowNode).attr('data-id', item.id);

                                if (!isNaN(parseFloat(detail.debit))) {
                                    totalDebit += parseFloat(detail.debit);
                                }
                                if (!isNaN(parseFloat(detail.kredit))) {
                                    totalKredit += parseFloat(detail.kredit);
                                }
                            });
                        });

                        $('#jurnal tfoot th:nth-child(2)').text('Rp. ' + totalDebit.toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
                        $('#jurnal tfoot th:nth-child(3)').text('Rp. ' + totalKredit.toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));

                        var startPeriod = moment(startDate).format('MMMM YYYY');
                        var period = startPeriod;
                        $('#print-link').attr('href', '{{ route("owner.jurnal") }}' + '?export=pdf&start_date=' + startDate + '&end_date=' + endDate);
                        $('p:contains("Per :")').text('Per : ' + period);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            @if($message = Session::get('failed'))
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{ $message }}",
            });
            @endif
            @if($message = Session::get('success'))
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "{{ $message }}",
            });
            @endif
        });
    </script>
@endsection