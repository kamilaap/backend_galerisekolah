<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hashtags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Pivot table untuk Informasi
        Schema::create('informasi_hashtag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('informasi_id')
                  ->constrained('informasi')
                  ->onDelete('cascade');
            $table->foreignId('hashtag_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->timestamps();
        });

        // Pivot table untuk Agenda
        Schema::create('agenda_hashtag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agenda_id')
                  ->constrained('agenda')
                  ->onDelete('cascade');
            $table->foreignId('hashtag_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->timestamps();
        });

        // Pivot table untuk Galery
        Schema::create('galery_hashtag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('galery_id')
                  ->constrained('galery')
                  ->onDelete('cascade');
            $table->foreignId('hashtag_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->timestamps();
        });

        // Pivot table untuk Photo
        Schema::create('photo_hashtag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('photo_id')
                  ->constrained('photos')
                  ->onDelete('cascade');
            $table->foreignId('hashtag_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('photo_hashtag');
        Schema::dropIfExists('galery_hashtag');
        Schema::dropIfExists('agenda_hashtag');
        Schema::dropIfExists('informasi_hashtag');
        Schema::dropIfExists('hashtags');
    }
};
