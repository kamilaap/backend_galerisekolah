<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galery', function (Blueprint $table) {
            $table->id();
    $table->string('judul'); // Judul galeri
    $table->text('deskripsi')->nullable(); // Deskripsi galeri
    $table->boolean('is_map')->default(false); // Menandakan jika ini adalah peta
    $table->date('tanggal');
    $table->string('status');
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
        Schema::dropIfExists('galery');
    }
};
