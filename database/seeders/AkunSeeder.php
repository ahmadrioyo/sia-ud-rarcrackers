<?php

namespace Database\Seeders;

use App\Models\Akun;
use App\Models\JenisTransaksi;
use App\Models\KelompokAkun;
use App\Models\TipeAkun;
use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // riwayat transaksi 
        
        Transaksi::updateOrCreate(
            [
                'nama_transaksi_perkiraan' => 'Saldo Awal',
                'tanggal' => '2024-04-01',
                'jumlah' => '2309000',
                'keterangan' => 'Saldo Awal Bulan April 2024',
            ],
            [
                'nama_transaksi_perkiraan' => 'Saldo Awal',
                'tanggal' => '2024-04-01',
                'jumlah' => '2309000',
                'keterangan' => 'Saldo Awal Bulan April 2024',
            ]
        );
        Transaksi::updateOrCreate(
            [
                'nama_transaksi_perkiraan' => 'Pembelian',
                'tanggal' => '2024-04-01',
                'jumlah' => '35000',
                'keterangan' => 'Pembelian serok sebanyak 2 buah',
            ],
            [
                'nama_transaksi_perkiraan' => 'Pembelian',
                'tanggal' => '2024-04-01',
                'jumlah' => '35000',
                'keterangan' => 'Pembelian serok sebanyak 2 buah',
            ]
        );
        Transaksi::updateOrCreate(
            [
                'nama_transaksi_perkiraan' => 'Pembelian',
                'tanggal' => '2024-04-01',
                'jumlah' => '345000',
                'keterangan' => 'Pembelian minyak dan tepung',
            ],
            [
                'nama_transaksi_perkiraan' => 'Pembelian',
                'tanggal' => '2024-04-01',
                'jumlah' => '345000',
                'keterangan' => 'Pembelian minyak dan tepung',
            ]
        );

        // tipe akun 
        TipeAkun::updateOrCreate(
            [
                'nama_tipe_akun' => 'Lancar',
                'kode_tipe_akun' => '1'
            ],
            [
                'nama_tipe_akun' => 'Lancar',
                'kode_tipe_akun' => '1'
            ]
        );
        TipeAkun::updateOrCreate(
            [
                'nama_tipe_akun' => 'Tetap',
                'kode_tipe_akun' => '2'
            ],
            [
                'nama_tipe_akun' => 'Tetap',
                'kode_tipe_akun' => '2'
            ]
        );
        TipeAkun::updateOrCreate(
            [
                'nama_tipe_akun' => 'Lain-lain',
                'kode_tipe_akun' => '3'
            ],
            [
                'nama_tipe_akun' => 'Lain-lain',
                'kode_tipe_akun' => '3'
            ]
        );

        // kelompok akun
        KelompokAkun::updateOrCreate(
            [
                'nama_kelompok_akun' => 'Harta',
                'kode_kelompok_akun' => '1'
            ],
            [
                'nama_kelompok_akun' => 'Harta',
                'kode_kelompok_akun' => '1'
            ]
        );
        KelompokAkun::updateOrCreate(
            [
                'nama_kelompok_akun' => 'Hutang',
                'kode_kelompok_akun' => '2'
            ],
            [
                'nama_kelompok_akun' => 'Hutang',
                'kode_kelompok_akun' => '2'
            ]
        );
        KelompokAkun::updateOrCreate(
            [
                'nama_kelompok_akun' => 'Modal',
                'kode_kelompok_akun' => '3'
            ],
            [
                'nama_kelompok_akun' => 'Modal',
                'kode_kelompok_akun' => '3'
            ]
        );
        KelompokAkun::updateOrCreate(
            [
                'nama_kelompok_akun' => 'Pendapatan',
                'kode_kelompok_akun' => '4'
            ],
            [
                'nama_kelompok_akun' => 'Pendapatan',
                'kode_kelompok_akun' => '4'
            ]
        );
        KelompokAkun::updateOrCreate(
            [
                'nama_kelompok_akun' => 'Beban',
                'kode_kelompok_akun' => '5'
            ],
            [
                'nama_kelompok_akun' => 'Beban',
                'kode_kelompok_akun' => '5'
            ]
        );
    }
}
