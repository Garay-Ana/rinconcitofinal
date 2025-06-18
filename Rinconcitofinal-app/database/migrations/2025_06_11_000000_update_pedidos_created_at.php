<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UpdatePedidosCreatedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * This migration updates the created_at timestamps of all existing pedidos
     * to the current timestamp to fix incorrect or outdated dates.
     *
     * @return void
     */
    public function up()
    {
        $now = Carbon::now('America/Bogota');

        DB::table('pedidos')->update([
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * This migration does not revert the created_at changes.
     *
     * @return void
     */
    public function down()
    {
        // No rollback for created_at update
    }
}
