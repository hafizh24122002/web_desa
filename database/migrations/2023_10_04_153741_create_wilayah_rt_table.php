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
        Schema::create('wilayah_rt', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('id_kepala_rt')->nullable()->constrained('ketua_rt')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_wilayah_dusun')->constrained('wilayah_dusun')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wilayah_rt');
    }
};
