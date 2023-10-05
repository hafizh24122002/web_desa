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
            $table->string('no_kk', 16)->nullable()->unique();
            $table->string('nik_kepala', 200)->nullable();
            $table->timestamp('tgl_daftar')->nullable()->useCurrent();
            $table->smallInteger('kelas_sosial')->nullable();
            $table->datetime('tgl_cetak_kk')->nullable();
            $table->string('alamat', 200)->nullable();
            // $table->foreignId('id_cluster')->constrained();
            // $table->foreignId('updated_by')->constrained('users');
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
