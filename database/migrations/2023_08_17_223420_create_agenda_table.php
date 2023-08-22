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
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_staf')->nullable()->default(NULL)->constrained('staf')->onUpdate('cascade')->onDelete('cascade');
            $table->string('judul');
            $table->longText('isi');
            $table->date('tgl_agenda');
            $table->string('lokasi')->nullable();
            $table->string('koordinator')->nullable();
            $table->boolean("is_active")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
