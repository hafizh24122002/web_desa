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
        Schema::create('ibu_hamil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_posyandu')->constrained('posyandu')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_kia')->constrained('kia')->onUpdate('cascade')->onDelete('cascade');
            $table->date('tanggal_periksa');
            $table->string('status_kehamilan');
            $table->integer('usia_kehamilan')->unsigned();
            $table->date('tanggal_melahirkan')->nullable()->default(null);
            $table->boolean('pemeriksaan_kehamilan')->default(false);
            $table->boolean('konsumsi_pil_fe')->default(false);
            $table->integer('butir_pil_fe')->unsigned()->nullable()->default(null);
            $table->boolean('pemeriksaan_nifas')->default(false);
            $table->boolean('konseling_gizi')->default(false);
            $table->boolean('kunjungan_rumah')->default(false);
            $table->boolean('akses_air_bersih')->default(false);
            $table->boolean('kepemilikan_jamban')->default(false);
            $table->boolean('jaminan_kesehatan')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ibu_hamil');
    }
};
