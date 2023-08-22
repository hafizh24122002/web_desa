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
        Schema::create('identitas_desa', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_desa')->nullable()->default('malik');
            $table->string('kode_desa')->nullable();
            $table->string('kode_pos_desa')->nullable();
            $table->string('nama_kepala_desa')->nullable();
            $table->string('nip_kepala_desa')->nullable();
            $table->string('alamat_kantor')->nullable();
            $table->string('email_desa')->nullable();
            $table->string('telepon')->nullable();
            $table->string('website')->nullable();
            $table->string('nama_kecamatan')->nullable();
            $table->string('kode_kecamatan')->nullable();
            $table->string('nama_kepala_camat')->nullable();
            $table->string('nip_kepala_camat')->nullable();
            $table->string('nama_kabupaten')->nullable();
            $table->string('kode_kabupaten')->nullable();
            $table->string('nama_provinsi')->nullable();
            $table->string('kode_provinsi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identitas_desas');
    }
};
