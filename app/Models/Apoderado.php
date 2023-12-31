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

    public function pagos(){
        return $this->hasMany(Pago::class, 'idapoderado', 'idapoderado');
    }

    public function apoderado_postulantes(){
        return $this->belongsToMany(Postulante::class, 'apoderado_postulante', 'idpostulante', 'idapoderado');
    }

    public static function getApoderadoById(string $id){
        return Apoderado::find($id);
    }
}
