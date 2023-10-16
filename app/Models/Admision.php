<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admision extends Model
{
    use HasFactory;
    protected $table = 'admisions';
    protected $primaryKey = 'idadmision';
    protected $fillable = ['año', 'fecha_apertura', 'fecha_cierre', 'tarifa', 'estado', 'eliminado'];
    public $timestamps = false;

    public function postulante_admision(){
        return $this->hasMany(PostulanteAdmision::class, 'idadmision', 'idadmision');        
    }
}
