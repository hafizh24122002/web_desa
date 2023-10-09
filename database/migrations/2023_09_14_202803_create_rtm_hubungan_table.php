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
        Schema::create('rtm_hubungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rt'); // Kolom ID RT
            $table->foreignId('id_penduduk'); // Kolom NIK
            // $table->string('no_kk'); // Kolom Nomor KK
            $table->string('hubungan')->nullable()->default(NULL); //'Kepala Rumah Tangga', 'Anggota'

            // Tambahkan indeks dan foreign keys
            // $table->foreign('id_no_rt')->references('id')->on('rt');
            // $table->foreign('nik')->references('nik')->on('penduduk');
            // $table->foreign('no_kk')->references('no_kk')->on('keluarga');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rtm_hubungan');
    }
};