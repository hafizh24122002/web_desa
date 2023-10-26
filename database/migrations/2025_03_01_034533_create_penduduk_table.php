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
            $table->string('no_kk_sebelumnya', 16)->nullable();            
            $table->foreignId('id_helper_penduduk_keluarga')->nullable()->constrained('helper_penduduk_keluarga')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_hubungan_kk')->nullable()->constrained('hubungan_kk')->onUpdate('cascade')->onDelete('cascade'); // *
            $table->foreignId('id_helper_penduduk_rtm')->nullable()->constrained('helper_penduduk_rtm')->onUpdate('cascade')->onDelete('cascade'); 
            $table->foreignId('id_rtm_hubungan')->nullable()->constrained('rtm_hubungan')->onUpdate('cascade')->onDelete('cascade'); 
            $table->foreignId('id_jenis_kelamin')->constrained('jenis_kelamin')->onUpdate('cascade')->onDelete('cascade')->nullable(); // *
            $table->string('tempat_lahir', 100)->nullable(); // *
            $table->date('tanggal_lahir')->nullable(); // *
            $table->foreignId('id_agama')->nullable()->constrained('agama')->onUpdate('cascade')->onDelete('cascade'); // *
            $table->boolean('penduduk_tetap')->default(true);
            $table->foreignId('id_pendidikan_terakhir')->nullable()->constrained('pendidikan_terakhir')->onUpdate('cascade')->onDelete('cascade'); // *
            $table->foreignId('id_pendidikan_saat_ini')->nullable()->constrained('pendidikan_saat_ini')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_pekerjaan')->nullable()->constrained('pekerjaan')->onUpdate('cascade')->onDelete('cascade'); // *
            $table->foreignId('id_status_perkawinan')->nullable()->constrained('status_perkawinan')->onUpdate('cascade')->onDelete('cascade'); // *
            $table->foreignId('id_kewarganegaraan')->nullable()->constrained('kewarganegaraan')->onUpdate('cascade')->onDelete('cascade')->default(1);
            $table->string('dokumen_pasport', 45)->nullable(); // kalau bukan penduduk tetap
            $table->string('dokumen_kitas', 45)->nullable(); // kalau bukan penduduk tetap
            $table->string('nik_ayah', 16)->nullable();
            $table->string('nik_ibu', 16)->nullable();
            $table->string('nama_ayah', 100)->nullable(); // *
            $table->string('nama_ibu', 100)->nullable(); // *
            $table->string('foto', 100)->nullable();
            $table->foreignId('id_golongan_darah')->nullable()->constrained('golongan_darah')->onUpdate('cascade')->onDelete('cascade'); // *
            $table->foreignId('id_dusun')->nullable()->constrained('wilayah_dusun')->onUpdate('cascade')->onDelete('cascade'); // *
            $table->foreignId('id_rt')->nullable()->constrained('wilayah_rt')->onUpdate('cascade')->onDelete('cascade'); // *
            $table->string('alamat_sebelumnya', 200)->nullable();
            $table->string('alamat_sekarang', 200)->nullable();
            $table->foreignId('id_status_dasar')->default(1); // hidup, mati, pindah, hilang, pergi, tidak valid
            $table->foreignId('id_cacat')->nullable()->constrained('cacat')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_sakit_menahun')->nullable()->constrained('sakit_menahun')->onUpdate('cascade')->onDelete('cascade');
            $table->string('akta_lahir', 40)->nullable();
            $table->string('akta_perkawinan', 40)->nullable();
            $table->date('tanggal_perkawinan')->nullable();
            $table->string('akta_perceraian', 40)->nullable();
            $table->date('tanggal_perceraian')->nullable();
            $table->foreignId('id_cara_kb')->nullable()->constrained('cara_kb')->onUpdate('cascade')->onDelete('cascade');
            $table->string('telepon', 20)->nullable();
            $table->date('tanggal_akhir_paspor')->nullable();
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
            $table->timestamps();
            $table->integer('created_by')->nullable(); // belum connect dengan user
            $table->integer('updated_by')->nullable(); // belum connect dengan user
            $table->foreignId('id_asuransi')->nullable()->constrained('asuransi')->onUpdate('cascade')->onDelete('cascade');
            $table->string('no_asuransi', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->integer('bahasa_id')->nullable();
            $table->text('ket')->nullable();
            $table->string('negara_asal', 50)->nullable();
            $table->string('tempat_cetak_ktp', 150)->nullable();
            $table->date('tanggal_cetak_ktp')->nullable();
            $table->string('suku', 150)->nullable();
            $table->string('bpjs_ketenagakerjaan', 100)->nullable();
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
