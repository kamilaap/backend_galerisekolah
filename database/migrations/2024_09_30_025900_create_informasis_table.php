<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformasisTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('informasi', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Judul informasi
            $table->text('deskripsi'); // Deskripsi informasi
            $table->string('image')->nullable(); // URL gambar, opsional
            $table->date('tanggal');
            $table->string('status'); // Status galeri, misalnya 'aktif' atau 'tidak aktif'
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade'); // Mengaitkan dengan kategori
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade'); // Mengaitkan dengan petugas yang membuat
            $table->timestamps(); // Waktu pembuatan dan pembaruan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi');
    }
};
