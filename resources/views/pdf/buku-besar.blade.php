<html>
  <head>
    <title>Laporan Buku Besar {{ $period }} | SIA UD. RAR Crackers</title>
    <link rel="stylesheet" href="asset/cetak.css">
  </head>
  <body>
            <table class="rangka" width="100%">
                <tr>
                    <td class="tengah">
                        <h3>Buku Besar</h3>
                        <h2>UD. RAR Crackers</h2>
                        <p>Per : {{ $period }}</p>
                        <p>Jalan Lawangan Daya II, Kecamatan Pademawu, Kabupaten Pamekasan</p>
                    </td>
                </tr>
            </table>
        @foreach($groupedData as $group => $entries)
            <table class="content-table" id="buku-besar-entries" width="100%">
                <thead style="background-color: #17a2b8">
                    <tr style="color: white">
                        <td colspan="5"><strong>{{ $group }}</strong></td>
                    </tr>
                    <tr style="color: white">
                        <th>Tanggal</th>
                        <th>Nama Transaksi Perkiraan</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entries as $entry)
                        <tr>
                            <td>{{ $entry->tanggal->formatLocalized('%d %B %Y') }}</td>
                            <td>{{ $entry->transaksi ? $entry->transaksi->nama_transaksi_perkiraan : 'Unknown Transaction' }}</td>
                            <td>{{'Rp. ' . number_format($entry->debit, 0, ',','.') }}</td>
                            <td>{{'Rp. ' . number_format($entry->kredit, 0, ',','.') }}</td>
                            <td>{{'Rp. ' . number_format($entry->saldo, 0, ',','.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                </tfoot>
            </table>
        @endforeach
  </body>
</html>