<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserIdNullableInPlatosTable extends Migration
{
    public function up()
    {
        // Primero eliminar la clave foránea en una llamada separada
        Schema::table('platos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Luego cambiar la columna a nullable
        Schema::table('platos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });

        // Finalmente, agregar la clave foránea nuevamente
        Schema::table('platos', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Primero eliminar la clave foránea en una llamada separada
        Schema::table('platos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Luego cambiar la columna a no nullable
        Schema::table('platos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });

        // Finalmente, agregar la clave foránea nuevamente
        Schema::table('platos', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
