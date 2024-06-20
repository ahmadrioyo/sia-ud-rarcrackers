<?php

use App\Models\KelompokAkun;
use App\Models\TipeAkun;
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
        Schema::create('akuns', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(KelompokAkun::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(TipeAkun::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('kode_akun');
            $table->string('nama_akun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akuns');
    }
};
