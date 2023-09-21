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
        Schema::create('rt', function (Blueprint $table) {
            $table->id();
            $table->string('no_rt'); // Kolom No. Rumah Tangga
            $table->foreignId('id_penduduk'); // Kolom NIK Kepala
            $table->foreignId('id_kelas_sosial'); // Kolom ID Kelas Sosial
            $table->string('bdt'); // Kolom BDT
            $table->date('tgl_daftar'); // Kolom Tanggal Daftar
            $table->integer('jumlah_anggota')->default(0); // Kolom Jumlah Anggota
            $table->string('alamat'); // Kolom Alamat
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rt');
    }
};
