<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    protected $table = 'citas';
    protected $primaryKey = 'id';
    protected $fillable = ['alumno_id','apoderado_id','citador_id','motivo','esCancelado','fueRealizado','fechaHoraInicio','fechaHoraFin','duracion'];
    public $timestamps = true;

    public function listarCitas(){
        return $this->join('alumnos', 'citas.alumno_id', '=', 'alumnos.idalumno')
        ->join('apoderados', 'citas.apoderado_id', '=', 'apoderados.idapoderado')
        ->join('users', 'citas.citador_id', '=', 'users.id')->get();
    }

    public function getCitaById(string $id): Cita{
        return $this->findById($id);
    }

    public function getCitasByAlumnoId(string $alumno_id){
        return $this->where('alumno_id', $alumno_id)->get();
    }

    public function crearCita(string $alumno_id, string $apoderado_id, string $citador_id, string $motivo, bool $esCancelado, bool $fueRealizado, string $fechaHoraInicio, string $fechaHoraFin, int $duracion): Cita{
        return $this->create([
            'alumno_id' => $alumno_id,
            'apoderado_id' => $apoderado_id,
            'citador_id' => $citador_id,
            'motivo' => $motivo,
            'esCancelado' => $esCancelado,
            'fueRealizado' => $fueRealizado,
            'fechaHoraInicio' => $fechaHoraInicio,
            'fechaHoraFin' => $fechaHoraFin,
            'duracionMinutos' => $duracion,
        ]);
    }

    public function actualizarCita(string $id, string $alumno_id, string $apoderado_id, string $citador_id, string $motivo, bool $esCancelado, bool $fueRealizado, string $fechaHoraInicio, string $fechaHoraFin, int $duracion): void{
        $this->where('id', $id)->update([
            'alumno_id' => $alumno_id,
            'apoderado_id' => $apoderado_id,
            'citador_id' => $citador_id,
            'motivo' => $motivo,
            'esCancelado' => $esCancelado,
            'fueRealizado' => $fueRealizado,
            'fechaHoraInicio' => $fechaHoraInicio,
            'fechaHoraFin' => $fechaHoraFin,
            'duracionMinutos' => $duracion,
        ]);
    }

    public function cancelarCita(string $id, bool $esCancelado){
        $this->where('id', $id)->update([
            'esCancelado' => $esCancelado,
            'fueRealizado' => false
        ]);
    }

    public function eliminarCita(string $id): void{
        $this->destroy($id);
    }
}
