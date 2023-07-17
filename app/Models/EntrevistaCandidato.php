<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrevistaCandidato extends Model
{
    use HasFactory;

    protected $table = 'rrhh_entrevistas';

    protected $fillable = [
        'evaluacion_id',
        'fecha',
        'hora',
        'estado',
        'observaciones',
        'entrevistador_id',
    ];

    protected $cast = [
        'fecha' => 'date',
        'hora' => 'time',
        'estado' => 'string',
    ];

    public function evaluacion()
    {
        return $this->belongsTo(EvaluacionCandidato::class);
    }

    public function entrevistador()
    {
        return $this->belongsTo(Empleado::class);
    }
}
