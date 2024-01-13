<?php

namespace App\Models\Rrhh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nomina extends Model
{
    use HasFactory;

    protected $fillable = [
        'empleado_id',
        'fecha_inicio',
        'fecha_fin',
        'sueldo_basico',
        'total_bruto',
        'total_neto',
        'estado_pago',
    ];

    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class);
    }

    public function descuentos(): HasMany
    {
        return $this->hasMany(Descuento::class);
    }

    public function prestaciones(): HasMany
    {
        return $this->hasMany(Prestacion::class);
    }
}
