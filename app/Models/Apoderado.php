<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apoderado extends Model
{
    use HasFactory;
    protected $table = 'apoderados';
    protected $primaryKey = 'idapoderado';
    protected $fillable = ['idusuario','nombre_apellidos', 'dni', 'fecha_nacimiento', 'numero_celular', 'ocupacion', 'centro_trabajo', 'correo', 'eliminado'];
    public $timestamps = false;
}
