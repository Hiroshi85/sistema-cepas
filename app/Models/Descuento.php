<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Descuento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomina_id',
        'concepto',
        'monto',
    ];

    public function Nomina(): BelongsTo
    {
        return $this->belongsTo(Nomina::class);
    }
}
