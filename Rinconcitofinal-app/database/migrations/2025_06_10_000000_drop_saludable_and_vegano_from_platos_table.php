<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSaludableAndVeganoFromPlatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('platos', function (Blueprint $table) {
            if (Schema::hasColumn('platos', 'saludable')) {
                $table->dropColumn('saludable');
            }
            if (Schema::hasColumn('platos', 'vegano')) {
                $table->dropColumn('vegano');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('platos', function (Blueprint $table) {
            $table->boolean('saludable')->default(false)->after('cantidad');
            $table->boolean('vegano')->default(false)->after('saludable');
        });
    }
}
