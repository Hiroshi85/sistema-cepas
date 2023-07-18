<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conducta extends Model
{
    use HasFactory;
    protected $table ="conducta";
    protected $primaryKey ="id";
    public $timestamps = false;
    protected $fillable = ['nombre', 'puntaje'];

    public function comportamientos(): HasMany
    {
        return $this->hasMany(Comportamiento::class);
    }

    public static function crearConducta(string $nombre, string $puntos): Conducta {
        return Conducta::create([
            'nombre' => $nombre,
            'puntaje' => $puntos,
        ]);
    }

    public static function obtenerConducta(string $id): Conducta {
        return Conducta::find($id);
    }

    public static function actualizarConducta(string $id, string $nombre, string $puntos): void{
        Conducta::where('id', $id)->update([
            'nombre'=>$nombre,
            'puntaje'=>$puntos,
        ]);
    }

    public static function eliminarConducta(string $id): int{
        return Conducta::destroy($id);
    }

    public static function listarDemeritos() {
        return Conducta::where('puntaje', '<', 0)->get();
    }

    public static function listarMeritos() {
        return Conducta::where('puntaje', '>', 0)->get();
    }
}
