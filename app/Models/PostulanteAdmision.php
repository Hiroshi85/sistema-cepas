<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostulanteAdmision extends Model
{
    use HasFactory;

    protected $table = 'postulante_admision';
    // protected $primaryKey = ['idadmision','idpostulante'];
    protected $fillable = ['idadmision','idpostulante','fecha_registro','resultado'];
    public $timestamps = false;

    public function postulante(){
        return $this->belongsTo(Postulante::class, 'idpostulante', 'idpostulante');
    }

    public function admision(){
        return $this->belongsTo(Admision::class, 'idadmision', 'idadmision');
    }
}
