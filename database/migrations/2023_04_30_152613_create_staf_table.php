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
        // TODO
        Schema::create('staf', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->nullable()->default(NULL);
            $table->string('nama');
            $table->string('jabatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staf');
    }
};
