<?php

namespace App\Models\Rrhh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Descuento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomina_id',
        'tipo_descuento_id',
        'monto',
    ];

    public function Nomina(): BelongsTo
    {
        return $this->belongsTo(Nomina::class);
    }
}
