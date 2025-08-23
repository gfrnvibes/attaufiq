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
        Schema::create('web_settings', function (Blueprint $table) {
            $table->id();
            $table->string('web_name')->unique();
            $table->string('web_logo')->unique();
            $table->string('web_tagline')->nullable();
            $table->string('web_description');
            $table->text('sambutan_kepsek')->nullable();
            $table->string('visi');
            $table->json('misi')->nullable();
            $table->text('sejarah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_settings');
    }
};
