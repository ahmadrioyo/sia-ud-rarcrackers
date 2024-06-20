<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailJurnal extends Model
{
    use HasFactory, HasFormatRupiah;
    protected $guarded;
    protected $primaryKey = 'id';

    public function jurnal()
    {
        return $this->belongsTo(Jurnal::class, 'jurnal_id', 'id');
    }

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id', 'id');
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }


}
