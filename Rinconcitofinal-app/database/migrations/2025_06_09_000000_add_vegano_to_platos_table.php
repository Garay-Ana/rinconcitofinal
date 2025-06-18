<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVeganoToPlatosTable extends Migration
{
    public function up()
    {
        Schema::table('platos', function (Blueprint $table) {
            $table->boolean('vegano')->default(false)->after('saludable');
        });
    }

    public function down()
    {
        Schema::table('platos', function (Blueprint $table) {
            $table->dropColumn('vegano');
        });
    }
}
