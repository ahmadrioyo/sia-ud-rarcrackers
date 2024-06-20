<html>
  <head>
    <title>Laporan Jurnal Umum {{ $period }} | SIA UD. RAR Crackers</title>
    <link rel="stylesheet" href="asset/cetak.css">
  </head>
  <body>
    <table width="100%" class="rangka">
      <tr>
          <td class="tengah">
              <h3>Jurnal Umum</h3>
              <h2>UD. RAR Crackers</h2>
              <p>Per : {{ $period }}</p>
              <p>Jalan Lawangan Daya II, Kecamatan Pademawu, Kabupaten Pamekasan</p>
          </td>
      </tr>
    </table>
    <table id="jurnal" class="content-table" width="100%">
      <thead style="background-color: #17a2b8">
      <tr style="color: white">
        <th>Tanggal</th>
        <th>Nama Akun</th>
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
                  <td width="15%">{{ $detail->formatRupiah('debit') }}</td>
                  <td width="15%">{{ $detail->formatRupiah('kredit') }}</td>
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
  </body>
</html>