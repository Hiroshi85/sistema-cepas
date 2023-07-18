<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulante extends Model
{
    use HasFactory;
    protected $table = 'postulantes';
    protected $primaryKey = 'idpostulante';
    protected $fillable = ['idpostulante','idaula','nombre_apellidos', 'fecha_nacimiento', 'dni', 'domicilio', 'numero_celular', 'nro_hermanos', 'fecha_postulacion', 'estado', 'eliminado'];
    public $timestamps = false;
}
