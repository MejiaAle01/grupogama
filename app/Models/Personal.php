<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personal extends Model
{
    use SoftDeletes;

    protected $table = 'personal';

    protected $primaryKey = 'id';

    protected $fillable = [
        'fechaRecepcion',
        'nombreEmpleado',
        'codigoEmpleado',
        'cargoEmpleado',
        'proyectoEmpleado',
        'accion',
        'fechaefectivo',
        'nombreUnidad',
        'centroCosto',
        'puestoActual',
        'salarioActual',
        'nombreUnidadPropuesto',
        'centroCostoPropuesto',
        'puestoPropuesto',
        'nuevoSalario',
        'fechaAumento',
        'infoRequerida',
        'firmaEmpleado',
        'firmaJefe',
        'firmaGerente',
        'firmaDirector'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
