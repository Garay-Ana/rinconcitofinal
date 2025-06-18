<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resena extends Model
{
    protected $fillable = ['user_id', 'plato_id', 'calificacion', 'comentario'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plato(): BelongsTo
    {
        return $this->belongsTo(Plato::class);
    }
}
