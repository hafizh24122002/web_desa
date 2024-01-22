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
        Schema::create('keluarga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_helper_penduduk_keluarga')->constrained('helper_penduduk_keluarga')->onUpdate('cascade')->onDelete('cascade'); // *
            $table->timestamp('tgl_daftar')->nullable()->useCurrent();
            $table->foreignId('id_kelas_sosial')->nullable()->constrained('kelas_sosial')->onUpdate('cascade')->onDelete('cascade');
            $table->datetime('tgl_cetak_kk')->nullable();
            $table->string('alamat', 200)->nullable();
            $table->foreignId('id_dusun')->nullable()->constrained('wilayah_dusun')->onUpdate('cascade')->onDelete('cascade'); // *
            $table->foreignId('id_rt')->nullable()->constrained('wilayah_rt')->onUpdate('cascade')->onDelete('cascade'); // *
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluarga');
    }
};
