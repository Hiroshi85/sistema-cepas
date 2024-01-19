<?php

namespace App\Models\Rrhh;

use App\Models\TipoPrestacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomina_id',
        'tipo_prestacion_id',
        'monto'
    ];

    protected $table = 'prestaciones';
    public function Nomina(): BelongsTo
    {
        return $this->belongsTo(Nomina::class);
    }

    public function tipoPrestacion(): BelongsTo
    {
        return $this->belongsTo(TipoPrestacion::class);
    }
}
