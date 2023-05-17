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
            $table->string('no_kk');
            $table->string('nik_kepala')->nullable();
            $table->foreignId('id_kelas_sosial')->nullable()->default(NULL)->constrained('kelas_sosial')->onUpdate('cascade')->onDelete('cascade');
            $table->string('alamat')->nullable();
            $table->date('tgl_dikeluarkan')->nullable();
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
