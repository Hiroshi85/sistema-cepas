<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoApoderado extends Model
{
    use HasFactory;
    protected $table = 'documento_apoderado';
    protected $primaryKey = 'iddocumento';
    protected $fillable = ['idapoderado', 'descripcion', 'imagen', 'fecha_registro','observacion','estado', 'eliminado'];
    public $timestamps = false;
}
