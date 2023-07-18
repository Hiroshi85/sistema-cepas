<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material_Escolar extends Model
{
    use HasFactory;
    protected $table = 'material_escolar';
    protected $primaryKey = 'material_id';
    protected $fillable = [
        'nombre',
        'descripcion',
        'stock'
    ];
    public $timestamps = true;

}
