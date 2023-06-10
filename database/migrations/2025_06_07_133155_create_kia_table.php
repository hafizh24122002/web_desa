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
        Schema::create('kia', function (Blueprint $table) {
            $table->id();
            $table->string('no_kia');
            $table->foreignId('id_anak')->nullable()->default(NULL)->constrained('penduduk')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_ibu')->constrained('penduduk')->onUpdate('cascade')->onDelete('cascade');
            $table->date('perkiraan_lahir')->nullable()->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kia');
    }
};
