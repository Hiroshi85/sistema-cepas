<?php

namespace App\Models\Academia\Cursos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoAcademia extends Model
{
    use HasFactory;

    // table
    protected $table = 'cursos_academia';

    // primary key
    protected $primaryKey = 'id';

    // fillable
    protected $fillable = [
        'nombre',
        'descripcion'
    ];
}
