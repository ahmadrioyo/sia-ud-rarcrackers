
<div class="container-fluid">
    <table width="100%">
        <tr>
            <td style="text-align: center">
                <h4>Buku Besar</h4>
                <h3>UD. RAR Crackers</h3>
                <p>Per : {{ $period }}</p>
                <p>Jalan Lawangan Daya II, Kecamatan Pademawu, Kabupaten Pamekasan</p>
            </td>
        </tr>
    </table>
</div>
<div id="buku-besar-entries">
    @foreach($groupedData as $group => $entries)
        <table class="table table-bordered">
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
                        <td>{{ $entry->transaksi->nama_transaksi_perkiraan }}</td>
                        <td>Rp. {{ number_format($entry->debit, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($entry->kredit, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($entry->saldo, 0, ',', '.') }}</td>
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
</div>
