<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSaludableToPlatosTable extends Migration
{
    public function up()
    {
        Schema::table('platos', function (Blueprint $table) {
            $table->boolean('saludable')->default(false)->after('cantidad');
        });
    }

    public function down()
    {
        Schema::table('platos', function (Blueprint $table) {
            $table->dropColumn('saludable');
        });
    }
}
