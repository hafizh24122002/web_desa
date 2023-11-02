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
        Schema::create('rtm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_helper_penduduk_rtm')->constrained('helper_penduduk_rtm')->onUpdate('cascade')->onDelete('cascade'); // *
            $table->foreignId('id_kelas_sosial')->nullable()->constrained('kelas_sosial')->onUpdate('cascade')->onDelete('cascade');
            $table->string('bdt')->nullable(); 
            $table->boolean('dtks')->default(false); // Kolom DTKS
            $table->timestamp('tgl_daftar')->nullable()->useCurrent();
            $table->string('alamat')->nullable();
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
        Schema::dropIfExists('rtm');
    }
};
