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
        Schema::create('kia_anak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_posyandu')->constrained('posyandu')->onUpdate('cascade')->onUpdate('cascade');
            $table->foreignId('id_kia')->constrained('kia')->onUpdate('cascade')->onDelete('cascade');
            $table->date('tanggal_periksa');
            $table->string('status_gizi_anak');
            $table->integer('umur')->unsigned()->nullable()->default(null);
            $table->string('hasil_status_tikar');
            $table->boolean('imunisasi_campak');
            $table->integer('berat_badan')->nullable()->default(null);
            $table->integer('tinggi_badan')->nullable()->default(null);
            $table->boolean('imunisasi_dasar')->default(false);
            $table->boolean('pengukuran_berat_badan')->default(false);
            $table->boolean('pengukuran_tinggi_badan')->default(false);
            $table->boolean('konseling_gizi_ayah')->default(false);
            $table->boolean('konseling_gizi_ibu')->default(false);
            $table->boolean('kunjungan_rumah')->default(false);
            $table->boolean('akses_air_bersih')->default(false);
            $table->boolean('kepemilikan_jamban')->default(false);
            $table->boolean('akta_lahir')->default(false);
            $table->boolean('jaminan_kesehatan')->default(false);
            $table->boolean('pengasuhan_paud')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kia_anak');
    }
};
