<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCantidadToPlatosTable extends Migration
{
    public function up()
    {
        Schema::table('platos', function (Blueprint $table) {
            $table->integer('cantidad')->default(10)->after('precio');
        });
    }

    public function down()
    {
        Schema::table('platos', function (Blueprint $table) {
            $table->dropColumn('cantidad');
        });
    }
}
