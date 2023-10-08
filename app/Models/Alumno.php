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

    // $table->id('idalumno');

    // $table->unsignedBigInteger('idaula');
    // $table->unsignedBigInteger('idpostulante');

    // $table->string('nombre_apellidos', 100);
    // $table->date('fecha_nacimiento');
    // $table->char('dni', 8)->unique();
    // $table->string('domicilio', 100);
    // $table->char('numero_celular', 9)->unique();
    // $table->integer('nro_hermanos');

    // $table->string('estado', 100);
    // $table->boolean('eliminado')->default(false);

    // $table->foreign('idaula')->references('idaula')->on('aulas');
    // $table->foreign('idpostulante')->references('idpostulante')->on('postulantes');
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
}
