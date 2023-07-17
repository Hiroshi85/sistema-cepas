<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApoderadoPostulante extends Model
{
    use HasFactory;
    protected $table = 'apoderado_postulante';
    // protected $primaryKey = 'idapoderado';
    protected $fillable = ['idapoderado', 'idpostulante', 'parentesco', 'convivencia', 'eliminado'];
    public $timestamps = false;
}
