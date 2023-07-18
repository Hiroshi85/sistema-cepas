<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoAlumno extends Model
{
    use HasFactory;
    protected $table = 'documento_alumno';
    protected $primaryKey = 'iddocumento';
    protected $fillable = ['idalumno', 'descripcion', 'imagen', 'fecha_registro','observacion','estado', 'eliminado'];
    public $timestamps = false;
}
