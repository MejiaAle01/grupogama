<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class HorasExtras extends Model
{
    use SoftDeletes;

    protected $table = 'horas_extras';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'nombreEmpleado',
        'fecha',
        'dia',
        'numeroHoras',
        'inicioHora',
        'finHora',
        'proyecto',
        'codigoEmpleado',
        'observaciones',
        'firmaEmpleado',
        'firmaAutorizado'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
