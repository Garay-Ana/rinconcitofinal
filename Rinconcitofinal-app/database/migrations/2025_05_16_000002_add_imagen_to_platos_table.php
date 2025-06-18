<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagenToPlatosTable extends Migration
{
    public function up()
    {
        Schema::table('platos', function (Blueprint $table) {
            $table->string('imagen')->nullable()->after('precio');
        });
    }

    public function down()
    {
        Schema::table('platos', function (Blueprint $table) {
            $table->dropColumn('imagen');
        });
    }
}
