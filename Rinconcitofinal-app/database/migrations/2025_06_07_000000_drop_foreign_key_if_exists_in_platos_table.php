<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DropForeignKeyIfExistsInPlatosTable extends Migration
{
    public function up()
    {
        // Obtener el nombre de la clave foránea si existe
        $foreignKeyName = null;
        $databaseName = DB::getDatabaseName();

        $result = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = ? 
              AND TABLE_NAME = 'platos' 
              AND COLUMN_NAME = 'user_id' 
              AND REFERENCED_TABLE_NAME = 'users'
        ", [$databaseName]);

        if (!empty($result)) {
            $foreignKeyName = $result[0]->CONSTRAINT_NAME;
        }

        if ($foreignKeyName) {
            Schema::table('platos', function (Blueprint $table) use ($foreignKeyName) {
                $table->dropForeign($foreignKeyName);
            });
        }
    }

    public function down()
    {
        Schema::table('platos', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
