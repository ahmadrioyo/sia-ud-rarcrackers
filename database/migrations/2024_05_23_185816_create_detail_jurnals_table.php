<?php

use App\Models\Akun;
use App\Models\Jurnal;
use App\Models\Transaksi;
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
        Schema::create('detail_jurnals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Jurnal::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(Transaksi::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(Akun::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('debit', 12, 2)->nullable();
            $table->decimal('kredit', 12, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_jurnals');
    }
};
