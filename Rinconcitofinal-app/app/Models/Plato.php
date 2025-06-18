<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Plato extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'ingredientes',
        'precio',
        'imagen',
        'cantidad',
        'saludable',
        'incluir_en_saludables',
        'tipo_comida',
        'descuento_porcentaje',
        'fecha_inicio_oferta',
        'fecha_fin_oferta',
        'user_id',
         'vegano',
    ];

    protected $casts = [
        'vegano' => 'boolean',
        'saludable' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function isEnOferta()
    {
        $hoy = Carbon::today();
        return $this->descuento_porcentaje !== null
            && $this->fecha_inicio_oferta !== null
            && $this->fecha_fin_oferta !== null
            && $hoy->between(Carbon::parse($this->fecha_inicio_oferta), Carbon::parse($this->fecha_fin_oferta));
    }

    public function precioConDescuento()
    {
        if ($this->isEnOferta()) {
            return round($this->precio * (1 - $this->descuento_porcentaje / 100), 2);
        }
        return $this->precio;
    }
}
