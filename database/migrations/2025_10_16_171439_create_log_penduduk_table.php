<?php

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
        Schema::create('log_penduduk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penduduk')->constrained('penduduk')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_peristiwa')->nullable()->constrained('peristiwa')->onUpdate('cascade')->onUpdate('cascade');
            $table->string('meninggal_di', 50)->nullable();
            $table->time('jam_mati')->nullable();
            $table->string('sebab', 50)->nullable();
            $table->string('penolong_mati', 50)->nullable();
            $table->string('no_akta_mati', 50)->nullable();
            $table->string('alamat_tujuan')->nullable();
            $table->date('tanggal_lapor');
            $table->date('tanggal_peristiwa');
            $table->text('catatan')->nullable();
            $table->foreignId('id_pindah')->nullable()->constrained('pindah')->onUpdate('cascade')->onDelete('cascade');
            $table->string('maksud_tujuan_kedatangan', 50)->nullable();
            $table->timestamps();

            $table->unique(['id_penduduk', 'id_peristiwa', 'tanggal_peristiwa'], 'log_penduduk_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_penduduk');
    }
};
