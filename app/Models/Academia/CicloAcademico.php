<?php

namespace App\Models\Academia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;

class CicloAcademico extends Model
{
    use HasFactory;

    protected $table = 'ciclo_academico';

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'activo',
        'public_id'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'activo' => 'boolean'
    ];

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'idciclo_academico');
    }

    public function solicitudesPendientes()
    {
        return $this->solicitudes()->where('estado', 'pendiente');
    }

    public function resolveRouteBinding($value, $field = null): ?Model
    {
        $id = last(explode('-', $value));

        $model = parent::resolveRouteBinding($id, $field);

        if (!$model || $model->getRouteKey() == $value){
            return $model;
        }

        throw new HttpResponseException(
            // TODO:redirect to the same route
            redirect()->route('academia.ciclo.show', $model->getRouteKey())
        );
    }

    public function getRouteKeyName(): string
    {
        return 'public_id';
    }

    public function getRouteKey()
    {
        return Str::slug($this->nombre).'-'.$this->public_id;
    }
}
