<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
    use HasFactory;
    protected $table = 'entrevistas';
    protected $primaryKey = 'identrevista';
    protected $fillable = ['idpostulante', 'idapoderado', 'fecha', 'hora', 'resultado', 'estado', 'eliminado'];
    public $timestamps = false;
    //Fillables
    //$table->unsignedBigInteger('idpostulante');
    // $table->unsignedBigInteger('idapoderado');
    // $table->date('fecha');
    // $table->time('hora');
    // $table->string('resultado', 100);
    // $table->string('estado', 100);
    // $table->boolean('eliminado')->default(false);
}
