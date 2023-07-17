<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleHorario extends Model
{
    use HasFactory;

    protected $fillable = [
        'horario_id',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'asignatura_id',
        'numero_aula'
    ];

    public function horario(): BelongsTo
    {
        return $this->belongsTo(Horario::class);
    }

    public function asignatura(): BelongsTo
    {
        return $this->belongsTo(Asignatura::class);
    }
}
