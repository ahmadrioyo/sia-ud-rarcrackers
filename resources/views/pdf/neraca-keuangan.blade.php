<!DOCTYPE html>
<html>
<head>
    <title>Laporan Neraca Keuangan {{ $period }} | SIA UD. RAR Crackers</title>
    <link rel="stylesheet" href="asset/cetak.css">
</head>
<body>
    <div class="row">
        <table class="rangka" width="100%">
            <tr>
                <td class="tengah">
                    <h3>Laporan Neraca</h3>
                    <h2>UD. RAR Crackers</h2>
                    <p>Per : {{ $period }}</p>
                    <p>Jalan Lawangan Daya II, Kecamatan Pademawu, Kabupaten Pamekasan</p>
                </td>
            </tr>
        </table>
        <table class="content-table col" width="100%">
            <thead>
                <tr>
                    <th></th>
                    <th style="text-align: center">Aktiva</th>
                    <th></th>
                </tr>
                <tr>
                    <td>Harta</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($totalPerAkun as $namaAkun => $total)
                @if (isset($groupedData[$namaAkun]) && $groupedData[$namaAkun]['kelompok'] === 'Harta')
                <tr>
                    <td>{{ $namaAkun }}</td>
                    <td>Rp. {{ number_format($total > 0 ? $total : 0, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($total < 0 ? abs($total) : 0, 0, ',', '.') }}</td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        <table class="content-table col" width="100%">
            <thead>
                <tr>
                    <th></th>
                    <th style="text-align: center">Pasiva</th>
                    <th></th>
                </tr>
                <tr>
                    <td>Hutang dan Modal</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($totalPerAkun as $namaAkun => $total)
                @if (isset($groupedData[$namaAkun]) && ($groupedData[$namaAkun]['kelompok'] === 'Hutang' || $groupedData[$namaAkun]['kelompok'] === 'Modal'))
                <tr>
                    <td>{{ $namaAkun }}</td>
                    <td>Rp. {{ number_format($total < 0 ? abs($total) : 0, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($total > 0 ? $total : 0, 0, ',', '.') }}</td>
                </tr>
                @endif
                @endforeach
                <tr>
                    <td><strong>Laba Bersih</strong></td>
                    <td></td>
                    <td><strong>Rp. {{ number_format($labaRugi, 0, ',', '.') }}</strong></td>
                </tr>
                {{-- <tr>
                    <td><strong>Total Modal</strong></td>
                    <td><strong>Rp. {{ number_format($totalModal < 0 ? abs($totalModal) : 0, 0, ',', '.') }}</strong></td>
                    <td><strong>Rp. {{ number_format($totalModal > 0 ? $totalModal : 0, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <td><strong>Total Hutang</strong></td>
                    <td><strong>Rp. {{ number_format($totalHutang < 0 ? abs($totalHutang) : 0, 0, ',', '.') }}</strong></td>
                    <td><strong>Rp. {{ number_format($totalHutang > 0 ? $totalHutang : 0, 0, ',', '.') }}</strong></td>
                </tr> --}}
            </tbody>
        </table>
    </div>
    <div class="row" width="100%">
        <table class="content-table col">
            <tfoot>
                <tr>
                    <td><strong>Total Aktiva</strong></td>
                    <td><strong>Rp. {{ number_format($totalAktiva, 0, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>
        <table class="content-table col">
            <tfoot>
                <tr>
                    <td><strong>Total Pasiva</strong></td>
                    <td><strong>Rp. {{ number_format($totalPasiva, 0, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
