<?php

use App\Models\Akun;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipe_akuns', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tipe_akun');
            $table->string('kode_tipe_akun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipe_akuns');
    }
};
