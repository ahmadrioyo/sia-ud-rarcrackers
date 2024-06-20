<html>
  <head>
    <title>Laporan Perubahan Modal {{ $period }} | SIA UD. RAR Crackers</title>
    <link rel="stylesheet" href="asset/cetak.css">
  </head>
  <body>
        <table width="100%" class="rangka">
          <tr>
              <td class="tengah">
                  <h3>Perubahan Modal</h3>
                  <h2>UD. RAR Crackers</h2>
                  <p>Per : {{ $period }}</p>
                  <p>Jalan Lawangan Daya II, Kecamatan Pademawu, Kabupaten Pamekasan</p>
              </td>
          </tr>
        </table>
      <table id="perubahanmodal" class="content-table" width="100%">
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
          <td>{{ $data['modal_akhir'] }}</td>
        </tr>
        </tfoot>
      </table>
  </body>
</html>