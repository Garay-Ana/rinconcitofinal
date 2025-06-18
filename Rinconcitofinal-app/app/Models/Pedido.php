<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Pedido extends Model
{
    protected $fillable = ['cliente_id', 'plato_id', 'estado', 'cantidad', 'precio_con_descuento'];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function plato(): BelongsTo
    {
        return $this->belongsTo(Plato::class, 'plato_id');
    }
}
