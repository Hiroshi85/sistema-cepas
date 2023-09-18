<?php

namespace App\Models\Academia\Cursos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    use HasFactory;

    protected $table = 'facultad_unt';

    protected $fillable = [
        'nombre',
        'descripcion',
        'eliminado',
        'slug',
    ];
}
