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
}
