<?php

namespace App\Models\Academia\Cursos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $table = 'carreras_unt';

    protected $fillable = [
        'nombre',
        'descripcion',
        'eliminado',
        'slug',
        'idarea',
        'idfacultad',
    ];

    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'idfacultad');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'idarea');
    }


}
