<?php

namespace App\Models\Academia\Cursos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'areas_unt';

    protected $fillable = [
        'nombre',
        'descripcion',
        'eliminado',
        'slug',
    ];

}
