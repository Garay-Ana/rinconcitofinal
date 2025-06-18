<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResenasTable extends Migration
{
    public function up()
    {
        Schema::create('resenas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('plato_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('calificacion')->unsigned(); // rating 1-5
            $table->text('comentario')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('resenas');
    }
}
