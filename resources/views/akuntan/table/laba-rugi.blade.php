<div class="container-fluid">
    <table width="100%">
        <tr>
            <td style="text-align: center">
                <h4>Laporan Laba Rugi</h4>
                <h3>UD. RAR Crackers</h3>
                <p>Per: {{ $period }}</p>
                <p>Jalan Lawangan Daya II, Kecamatan Pademawu, Kabupaten Pamekasan</p>
            </td>
        </tr>
    </table>
</div>
<table class="table table-bordered">
    <thead style="background-color: #17a2b8">
        <tr style="color: white">
            <th>Kode Akun</th>
            <th>Nama Akun</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="3"><strong>Pendapatan</strong></td>
        </tr>
        @foreach($pendapatan as $value)
            <tr>
                <td>[{{ $value['kode_akun'] }}]</td>
                <td>{{ $value['nama_akun'] }}</td>
                <td>{{ 'Rp. ' . number_format($value['total'], 0, ',', '.') }}</td>
            </tr>
        @endforeach    
        <tr>
            <td colspan="2"><strong>Total Pendapatan</strong></td>
            <td><strong>{{ 'Rp. ' . number_format($totalPendapatan,0, ',', '.') }}</strong></td>
        </tr>
        <tr>
            <td colspan="3"><strong>Beban</strong></td>
        </tr>
        @foreach($beban as $value)
            <tr>
                <td>[{{ $value['kode_akun'] }}]</td>
                <td>{{ $value['nama_akun'] }}</td>
                <td>{{ 'Rp. ' . number_format($value['total'], 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2"><strong>Total Beban</strong></td>
            <td><strong>{{ 'Rp. ' . number_format($totalBeban, 0, ',', '.') }}</strong></td>
        </tr>
        <tr>
            <td colspan="2"><strong>Laba Bersih</strong></td>
            <td><strong>{{ 'Rp. ' . number_format($labaBersih, 0, ',', '.') }}</strong></td>
        </tr>
    </tbody>
</table>