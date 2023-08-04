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
        Schema::create('sasaran_paud', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kia')->constrained('kia')->onUpdate('cascade')->onDelete('cascade');
            $table->date('tanggal_periksa');
            $table->boolean('januari')->default(false);
            $table->boolean('februari')->default(false);
            $table->boolean('maret')->default(false);
            $table->boolean('april')->default(false);
            $table->boolean('mei')->default(false);
            $table->boolean('juni')->default(false);
            $table->boolean('juli')->default(false);
            $table->boolean('agustus')->default(false);
            $table->boolean('september')->default(false);
            $table->boolean('oktober')->default(false);
            $table->boolean('november')->default(false);
            $table->boolean('desember')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sasaran_paud');
    }
};
