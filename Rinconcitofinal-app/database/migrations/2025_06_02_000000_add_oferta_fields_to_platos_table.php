<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOfertaFieldsToPlatosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('platos', function (Blueprint $table) {
            $table->unsignedTinyInteger('descuento_porcentaje')->nullable()->after('precio');
            $table->date('fecha_inicio_oferta')->nullable()->after('descuento_porcentaje');
            $table->date('fecha_fin_oferta')->nullable()->after('fecha_inicio_oferta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('platos', function (Blueprint $table) {
            $table->dropColumn(['descuento_porcentaje', 'fecha_inicio_oferta', 'fecha_fin_oferta']);
        });
    }
}
