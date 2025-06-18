<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plato;
use Carbon\Carbon;

class ActualizarDescuentosPlatosSeeder extends Seeder
{
    public function run()
    {
        // Fecha actual
        $hoy = Carbon::today();

        // Actualizar algunos platos con descuento válido
        $platos = Plato::take(3)->get();

        foreach ($platos as $plato) {
            $plato->descuento_porcentaje = 20; // 20% de descuento
            $plato->fecha_inicio_oferta = $hoy->copy()->subDays(1);
            $plato->fecha_fin_oferta = $hoy->copy()->addDays(7);
            $plato->save();
        }
    }
}
