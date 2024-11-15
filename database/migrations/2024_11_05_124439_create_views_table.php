<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewsTable extends Migration
{
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('photo_id')->constrained()->onDelete('cascade'); // Foreign key to photo
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps(); // Created_at and Updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('views');
    }
}
