<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateIngredientesAndCantidadInPlatosTable extends Migration
{
    public function up()
    {
        Schema::table('platos', function (Blueprint $table) {
            if (!Schema::hasColumn('platos', 'ingredientes')) {
                $table->string('ingredientes')->nullable()->after('descripcion');
            }
            if (!Schema::hasColumn('platos', 'cantidad')) {
                $table->integer('cantidad')->default(0)->after('precio');
            }
        });

        // Opcional: actualizar registros existentes para evitar cantidad 10 por defecto y agregar ingredientes de ejemplo
        \DB::table('platos')->whereNull('ingredientes')->update(['ingredientes' => 'No especificado']);
        \DB::table('platos')->where('cantidad', 10)->update(['cantidad' => 0]);
    }

    public function down()
    {
        Schema::table('platos', function (Blueprint $table) {
            if (Schema::hasColumn('platos', 'ingredientes')) {
                $table->dropColumn('ingredientes');
            }
            if (Schema::hasColumn('platos', 'cantidad')) {
                $table->dropColumn('cantidad');
            }
        });
    }
}
