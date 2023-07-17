<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asignatura extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'grado',
    ];

    public function detallesHorarios(): HasMany
    {
        return $this->hasMany(DetalleHorario::class);
    }
}
