<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 

class Silabo extends Model
{
    use HasFactory;
    protected $table='silabo';
    protected $primaryKey = 'idsilabo';
    public $timestamps = false;
    protected $fillable=['namefile','idcurso'];

    public function cursoasignado(){
        return $this->hasOne(CursoAsignado::class,'idcurso','idcurso');
    }
}
