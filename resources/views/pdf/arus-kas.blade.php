<html>
  <head>
    <title>Laporan Arus Kas {{ $period }} | SIA UD. RAR Crackers</title>
    <link rel="stylesheet" href="asset/cetak.css">
  </head>
  <body>    
    <table width="100%" class="rangka">
        <tr>
            <td class="tengah">
                <h3>Arus Kas</h3>
                <h2>UD. RAR Crackers</h2>
                <p>Per :  {{ $period }}</p>
                <p>Jalan Lawangan Daya II, Kecamatan Pademawu, Kabupaten Pamekasan</p>
            </td>
        </tr>
    </table>
    <table id="aruskas" class="content-table" width=100%>
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
  </body>
</html>