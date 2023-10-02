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
            $table->string('nama', 100); // *
            $table->string('nik', 16)->nullable(); // *
            $table->integer('id_kk')->default(0); 
            $table->integer('id_hubungan_kk')->nullable(); // *
            // $table->string('id_rtm', 30)->nullable();
            // $table->integer('rtm_level')->nullable();
            // $table->string('jenis_kelamin')->default('L'); // *
            $table->foreignId('id_jenis_kelamin')->constrained('jenis_kelamin')->onUpdate('cascade')->onDelete('cascade')->nullable(); // *
            $table->string('tempat_lahir', 100)->nullable(); // *
            $table->date('tanggal_lahir')->nullable(); // *
            $table->foreignId('id_agama')->nullable()->constrained('agama')->onUpdate('cascade')->onDelete('cascade'); // *
            $table->foreignId('id_pendidikan_terakhir')->nullable()->constrained('pendidikan_terakhir')->onUpdate('cascade')->onDelete('cascade'); // *
            $table->foreignId('id_pendidikan_saat_ini')->nullable()->constrained('pendidikan_saat_ini')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_pekerjaan')->nullable()->constrained('pekerjaan')->onUpdate('cascade')->onDelete('cascade'); // *
            $table->foreignId('id_status_perkawinan')->nullable()->constrained('status_perkawinan')->onUpdate('cascade')->onDelete('cascade'); // *
            $table->foreignId('id_kewarganegaraan')->nullable()->constrained('kewarganegaraan')->onUpdate('cascade')->onDelete('cascade')->default(1);
            // $table->string('dokumen_pasport', 45)->nullable(); // kalau bukan penduduk tetap
            // $table->string('dokumen_kitas', 45)->nullable(); // kalau bukan penduduk tetap
            $table->string('nik_ayah', 16)->nullable();
            $table->string('nik_ibu', 16)->nullable();
            $table->string('nama_ayah', 100)->nullable(); // *
            $table->string('nama_ibu', 100)->nullable(); // *
            $table->string('foto', 100)->nullable();
            $table->foreignId('id_golongan_darah')->nullable()->constrained('golongan_darah')->onUpdate('cascade')->onDelete('cascade'); // *
            // $table->integer('id_cluster'); // TODO, untuk pemisahan alamat dusun - RW - RT 
            // $table->boolean('penduduk_tetap')->default(true); // *
            $table->foreignId('id_penduduk_status')->nullable()->constrained('penduduk_status')->onUpdate('cascade')->onDelete('cascade'); // *
            $table->string('alamat_sebelumnya', 200)->nullable();
            $table->string('alamat_sekarang', 200)->nullable();
            // $table->tinyInteger('status_dasar')->default(1); // hidup, mati, pindah, hilang, pergi, tidak valid
            $table->tinyInteger('hamil')->nullable();
            $table->integer('cacat_id')->nullable();
            $table->integer('sakit_menahun_id')->nullable();
            $table->string('akta_lahir', 40)->nullable();
            $table->string('akta_perkawinan', 40)->nullable();
            $table->date('tanggal_perkawinan')->nullable();
            $table->string('akta_perceraian', 40)->nullable();
            $table->date('tanggal_perceraian')->nullable();
            $table->tinyInteger('id_cara_kb')->nullable();
            $table->string('telepon', 20)->nullable();
            $table->date('tanggal_akhir_paspor')->nullable();
            $table->string('no_kk_sebelumnya', 30)->nullable();
            $table->tinyInteger('ktp_el')->nullable();
            $table->tinyInteger('status_rekam')->nullable();
            $table->string('waktu_lahir', 5)->nullable();
            $table->tinyInteger('tempat_dilahirkan')->nullable();
            $table->tinyInteger('jenis_kelahiran')->nullable();
            $table->tinyInteger('kelahiran_anak_ke')->nullable();
            $table->tinyInteger('penolong_kelahiran')->nullable();
            $table->smallInteger('berat_lahir')->nullable();
            $table->string('panjang_lahir', 10)->nullable();
            $table->string('tag_id_card', 17)->nullable();
            $table->timestamps(0);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->tinyInteger('id_asuransi')->nullable();
            $table->string('no_asuransi', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('email_token', 100)->nullable();
            $table->dateTime('email_tgl_kadaluarsa')->nullable();
            $table->dateTime('email_tgl_verifikasi')->nullable();
            $table->string('telegram', 100)->nullable();
            $table->string('telegram_token', 100)->nullable();
            $table->dateTime('telegram_tgl_kadaluarsa')->nullable();
            $table->dateTime('telegram_tgl_verifikasi')->nullable();
            $table->integer('bahasa_id')->nullable();
            $table->text('ket')->nullable();
            $table->string('negara_asal', 50)->nullable();
            $table->string('tempat_cetak_ktp', 150)->nullable();
            $table->date('tanggal_cetak_ktp')->nullable();
            $table->string('suku', 150)->nullable();
            $table->string('bpjs_ketenagakerjaan', 100)->nullable();
            // $table->string('hubung_warga', 50)->default('Telegram'); // *
            // $table->primary('id');
            // $table->unique('tag_id_card');
            // $table->unique('nik');
            // $table->unique('telegram');
            // $table->unique('telegram_token');
            // $table->unique('email_token');
            // $table->unique('email');
            // $table->index('id_rtm');
            // $table->index('hubung_warga');
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
