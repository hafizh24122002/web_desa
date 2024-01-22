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
        Schema::create('artikel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_staf')->nullable()->default(NULL)->constrained('staf')->onUpdate(NULL)->onDelete(NULL);
            $table->string('judul');
            $table->longText('isi');
            $table->foreignId('id_cover')->default(1)->constrained('images')->onUpdate(NULL)->onDelete(NULL);
            $table->boolean("is_active")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};
