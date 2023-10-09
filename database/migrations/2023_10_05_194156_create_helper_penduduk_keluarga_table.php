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
        Schema::create('helper_penduduk_keluarga', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk', 16)->nullable()->unique();
            $table->string('nik_kepala', 16)->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('helper_penduduk_keluarga');
    }
};
