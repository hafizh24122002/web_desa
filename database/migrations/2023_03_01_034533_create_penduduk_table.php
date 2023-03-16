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
        // Schema::create('penduduk', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('nama', 100);
        //     $table->string('nik', 16)->unique()->nullable()->default(NULL);
        //     $table->foreignId('id_kk', 11)->nullable()->default(NULL);
        //     $table->tinyInteger('kk_level', 2)->nullable()->default(NULL);
            

        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk');
    }
};
