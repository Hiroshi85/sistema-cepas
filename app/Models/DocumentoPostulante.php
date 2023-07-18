<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoPostulante extends Model
{
    use HasFactory;
    protected $table = 'documento_postulante';
    protected $primaryKey = 'iddocumento';
    protected $fillable = ['idpostulante', 'descripcion', 'imagen', 'fecha_registro','observacion','estado', 'eliminado'];
    public $timestamps = false;
}
