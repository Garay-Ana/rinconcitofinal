<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoComidaToPlatosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('platos', function (Blueprint $table) {
            $table->string('tipo_comida')->nullable()->after('saludable')->comment('Tipo de comida: vegana, tradicional, etc.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('platos', function (Blueprint $table) {
            $table->dropColumn('tipo_comida');
        });
    }
}
