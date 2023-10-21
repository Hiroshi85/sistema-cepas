<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sancion extends Model
{
    use HasFactory;
    protected $table='sanciones';
    public $timestamps = false;
    protected $fillable=['nombre'];

    public static function listarSanciones(){
        return Sancion::all();
    }

    public static function getSancion(int $id){
        return Sancion::find($id);
    }

    public static function crearSancion(string $nombre){
        return Sancion::create(['nombre'=>$nombre]);
    }

    public static function actualizarSancion($id, $nombre){
        $sancion=Sancion::find($id);
        $sancion->nombre=$nombre;
        $sancion->save();
        return $sancion;
    }

    public static function eliminarSancion($id){
        $sancion=Sancion::destroy($id);
    }
}
