<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Oferta extends Model
{
    use HasFactory;
    protected $fillable = [
        'puesto_id',
        'fecha_inicio',
        'fecha_fin',
        'descripcion',
        'salario',
        'beneficios',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function postulacion(): BelongsTo
    {
        return $this->belongsTo(Postulacion::class, 'candidato_id')
            ->whereInEager('plaza_id', $this->plaza_id);
    }
}
