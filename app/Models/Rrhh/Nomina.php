<?php

namespace App\Models\Rrhh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nomina extends Model
{
    use HasFactory;

    protected $fillable = [
        'empleado_id',
        'fecha_inicio',
        'fecha_fin',
        'sueldo_basico',
        'total_bruto',
        'total_neto',
        'estado_pago',
    ];

    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class);
    }

    public function descuentos(): HasMany
    {
        return $this->hasMany(Descuento::class);
    }

    public function prestaciones(): HasMany
    {
        return $this->hasMany(Prestacion::class);
    }

    public function totoalDescuentos(): float
    {
        return $this->descuentos->sum('monto');
    }

    public function totalPrestaciones(): float
    {
        return $this->prestaciones->sum('monto');
    }

    public function totalNeto(): float
    {
        return $this->totalBruto() - $this->totoalDescuentos() + $this->totalPrestaciones();
    }

    public function totalBruto(): float
    {
        return $this->sueldo_basico + $this->totalPrestaciones();
    }

    public function sueldoBasicoFormat(): string
    {
        return number_format($this->sueldo_basico, 2, ',', '.');
    }
    public function totalPrestacionesFormat(): string
    {
        return number_format($this->totalPrestaciones(), 2, ',', '.');
    }

    public function totalDescuentosFormat(): string
    {
        return number_format($this->totoalDescuentos(), 2, ',', '.');
    }

    public function totalBrutoFormat(): string
    {
        return number_format($this->totalBruto(), 2, ',', '.');
    }

    public function totalNetoFormat(): string
    {
        return number_format($this->totalNeto(), 2, ',', '.');
    }

    public function fechaInicioFormat(): string
    {
        return date('d/m/Y', strtotime($this->fecha_inicio));
    }

    public function fechaFinFormat(): string
    {
        return date('d/m/Y', strtotime($this->fecha_fin));
    }


    // CRUD METHODS
    public static function listarNominas(
        string $search = '',
        string $sortBy = 'id',
        string $sortDirection = 'desc',
    ) {
        return Nomina::where('id', 'like', '%' . $search . '%')
            ->orWhere('fecha_inicio', 'like', '%' . $search . '%')
            ->orWhere('fecha_fin', 'like', '%' . $search . '%')
            ->orWhere('sueldo_basico', 'like', '%' . $search . '%')
            ->orWhere('total_bruto', 'like', '%' . $search . '%')
            ->orWhere('total_neto', 'like', '%' . $search . '%')
            ->orWhere('estado_pago', 'like', '%' . $search . '%')
            ->orderBy($sortBy, $sortDirection)
            ->paginate(10);
    }
}
