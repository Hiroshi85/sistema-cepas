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

    public function pagos(){
        return $this->hasMany(Pago::class, 'idpostulante', 'idpostulante');
    }

    public function postulante_admision(){
        return $this->hasMany(PostulanteAdmision::class, 'idpostulante', 'idpostulante');
    }
    
    public function aula(){
        return $this->belongsTo(Aula::class, 'idaula', 'idaula');
    }
}
