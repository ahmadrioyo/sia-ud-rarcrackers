<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;
    use HasFormatRupiah;

    protected $guarded;
    protected $fillable = ['tanggal'];
    protected $casts = [
        'tanggal' => 'datetime'
    ];
    protected $dates = ['tanggal'];

    public function detail_jurnal()
    {
        return $this->hasMany(DetailJurnal::class);
    }
}