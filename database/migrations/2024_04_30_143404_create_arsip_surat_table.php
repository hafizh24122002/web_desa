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
        Schema::create('arsip_surat', function (Blueprint $table) {
            $table->id();
            $table->integer('no_surat')->unsigned()->unique();
            $table->foreignId('id_staf')->nullable()->default(NULL)->constrained('staf')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_klasifikasi_surat')->nullable()->default(NULL)->constrained('surat')->onUpdate('cascade')->onDelete('cascade');
            $table->string('keterangan')->nullable()->default(null);
            $table->string('filename');
            // $table->string('status')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_surat');
    }
};
