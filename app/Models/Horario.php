<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'horas_semana',
        'horas_mensuales',
        'empleado_id',
        'anho',
    ];

    public function empleado() : BelongsTo
    {
        return $this->belongsTo(Empleado::class);
    }

    public function detallesHorario() : HasMany
    {
        return $this->hasMany(DetalleHorario::class);
    }
}