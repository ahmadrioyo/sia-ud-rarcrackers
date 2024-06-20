<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Akun extends Model
{
    use HasFactory, HasFormatRupiah;

    protected $guarded = ['id'];
    protected $casts = ['tanggal' => 'datetime'];
    protected $dates = ['tanggal'];

    public function detail_jurnal()
    {
        return $this->hasMany(DetailJurnal::class);
    }

    public function kelompok_akuns()
    {
        return $this->belongsTo(KelompokAkun::class, 'kelompok_akun_id', 'id')->whereIn('nama_kelompok_akun', ['Harta','Hutang','Modal','Pendapatan', 'Beban']);
    }

    public function tipe_akuns()
    {
        return $this->belongsTo(TipeAkun::class, 'tipe_akun_id', 'id');
    }
}
