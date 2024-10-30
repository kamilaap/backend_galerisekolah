<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Judul agenda
            $table->text('deskripsi')->nullable(); // Deskripsi agenda
            $table->date('tanggal'); // Tanggal agenda
            $table->date('tanggal_post_agenda'); // Tanggal agenda
            $table->string('status');// Status galeri, misalnya 'aktif' atau 'tidak aktif'
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade'); // Mengaitkan dengan kategori
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade'); // Mengaitkan dengan petugas yang mengelola
            $table->timestamps(); // Waktu pembuatan dan pembaruan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda');
    }
};
