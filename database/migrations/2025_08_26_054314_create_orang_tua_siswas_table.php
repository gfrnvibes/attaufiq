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
        Schema::create('orang_tua_siswas', function (Blueprint $table) {
            $table->id();
            // siswa_id (FK → siswa.id)
            // tipe (enum/string: ayah | ibu | wali)
            // nama
            // nik (nullable)
            // pendidikan (nullable)
            // pekerjaan (nullable)
            // no_hp (nullable)
            // keadaan (nullable: hidup | alm)
            // tinggal_bersama (boolean default true)
            $table->foreignId('siswa_id')->constrained('pendaftaran_siswas')->onDelete('cascade');
            $table->string('nomor_kartu_keluarga')->nullable();
            $table->enum('tipe', ['ayah', 'ibu', 'wali']);
            $table->string('nama');
            $table->string('nik')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('no_hp')->nullable();
            $table->enum('keadaan', ['hidup', 'alm'])->nullable();
            // Jika tipe wali
            $table->string('hubungan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orang_tua_siswas');
    }
};
