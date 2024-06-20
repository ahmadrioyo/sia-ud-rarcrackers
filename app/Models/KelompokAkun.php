<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KelompokAkun extends Model
{
    use HasFactory, HasFormatRupiah;

    protected $guarded = ['id'];

    public function akuns()
    {
        return $this->hasMany(Akun::class)->withDefault();
    }

}