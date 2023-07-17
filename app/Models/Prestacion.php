<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomina_id',
        'concepto',
        'monto'
    ];

    protected $table = 'prestaciones';
    public function Nomina(): BelongsTo
    {
        return $this->belongsTo(Nomina::class);
    }
}
