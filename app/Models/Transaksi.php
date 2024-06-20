<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory, HasFormatRupiah;

    protected $guarded = ['id'];

    protected $casts = ['tanggal' => 'datetime'];
    protected $dates = ['tanggal'];

    public function jurnal()
    {
        return $this->hasMany(Jurnal::class)->withDefault();
    }
    
    public function detail_jurnal()
    {
        return $this->hasMany(DetailJurnal::class, 'jurnal_id', 'id');
    }
}
