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
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->string('nik', 16)->unique();
            $table->foreignId('id_kk', 11)->nullable()->default(NULL)->constrained('keluarga')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_hubungan_kk')->nullable()->default(NULL)->constrained('hubungan_kk')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_rtm')->nullable()->default(NULL);
            $table->string('jenis_kelamin')->nullable()->default(NULL);
            $table->string('tempat_lahir')->nullable()->default(NULL);
            $table->date('tanggal_lahir')->nullable()->default(NULL);
            $table->foreignId('id_agama')->nullable()->default(NULL)->constrained('agama')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_pendidikan_terakhir')->nullable()->default(NULL)->constrained('pendidikan_terakhir')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_pendidikan_saat_ini')->nullable()->default(NULL)->constrained('pendidikan_saat_ini')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_pekerjaan')->nullable()->default(NULL)->constrained('pekerjaan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_status_perkawinan')->nullable()->default(NULL)->constrained('status_perkawinan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_kewarganegaraan')->nullable()->default(NULL)->constrained('kewarganegaraan')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nik_ayah', 16)->nullable()->default(NULL);
            $table->string('nik_ibu', 16)->nullable()->default(NULL);
            $table->string('foto')->nullable()->default(NULL);
            $table->foreignId('id_golongan_darah')->nullable()->default(NULL);
            $table->boolean('penduduk_tetap')->nullable()->default(true);
            $table->string('alamat')->nullable()->default(NULL);
            $table->string('telepon')->nullable()->default(NULL);
            $table->foreignId('id_status_asuransi')->nullable()->default(NULL);
            $table->foreignId('status')->nullable()->default(NULL);
            $table->foreignId('id_kesehatan')->nullable()->default(NULL);
            $table->string('ket')->nullable()->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk');
    }
};
