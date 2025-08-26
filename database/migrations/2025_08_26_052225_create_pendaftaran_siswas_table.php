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
        Schema::create('pendaftaran_siswas', function (Blueprint $table) {
            $table->id();
            // Nama Lengkap, NIK, Jenis Kelamin, Tempat Lahir, Tanggal Lahir, Asal Sekolah, NISN (nullable), Anak Ke, Jumlah Saudara Kandung, No HP, Prestasi (json: cabang lomba, tingkat, prestasi)
            $table->string('nama_lengkap');
            $table->string('nik');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('asal_sekolah');
            $table->string('nisn')->nullable();
            $table->integer('anak_ke');
            $table->integer('jumlah_saudara_kandung');
            $table->string('no_hp');
            $table->json('prestasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_siswas');
    }
};
