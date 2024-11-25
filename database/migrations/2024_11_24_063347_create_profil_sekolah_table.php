<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('profil_sekolah');

        Schema::create('profil_sekolah', function (Blueprint $table) {
            $table->id();
            $table->text('deskripsi')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->string('video_url')->nullable();
            $table->string('welcome_title')->default('Selamat Datang Di Edu Galery');
            $table->string('welcome_subtitle')->default('Membangun Generasi Digital yang Unggul dan Berkarakter');
            $table->text('welcome_description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_sekolah');
    }
};
