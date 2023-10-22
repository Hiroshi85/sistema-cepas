<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $table = 'alumnos';
    protected $primaryKey = 'idalumno';
    protected $fillable = ['idaula','idpostulante','nombre_apellidos', 'fecha_nacimiento', 'dni', 'domicilio', 'numero_celular', 'nro_hermanos', 'estado', 'eliminado'];
    public $timestamps = false;

    public function asistencias()
    {
        return $this->hasMany(AsistenciaXDia::class);
    }

    public function comportamientos()
    {
        return $this->hasMany(Comportamiento::class);
    }

    public function asistencia(){
        return $this->hasMany(Asistencia::class,'idalumno','idalumno');
    }

    public function aula(){
        return $this->hasOne(Aula::class,'idaula','idaula');
    }

    public function pagos(){
        return $this->hasMany(Pago::class, 'idalumno', 'idalumno');
    }
    public static function buscarAlumnoPorString(string $nom_alumno){
        return Alumno::where('nombre_apellidos', 'like',"%".$nom_alumno."%")
            ->where('eliminado', 0)
            ->select("nombre_apellidos","idalumno")->get();
    }

    public static function getAlumnoById(int $id){
        return Alumno::with('aula')->find($id);
    }

    public function resultados(){
        return $this->hasMany(ResultadoPrueba::class,'alumno_id','idalumno');
    }

    //Alumno has one postulante
    public function postulante(){
        return $this->hasOne(Postulante::class,'idpostulante','idpostulante');
    }
}
