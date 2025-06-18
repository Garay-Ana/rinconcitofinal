<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIncluirEnSaludablesToPlatosTable extends Migration
{
    public function up()
    {
        Schema::table('platos', function (Blueprint $table) {
            $table->boolean('incluir_en_saludables')->default(false)->after('saludable');
        });
    }

    public function down()
    {
        Schema::table('platos', function (Blueprint $table) {
            $table->dropColumn('incluir_en_saludables');
        });
    }
}
