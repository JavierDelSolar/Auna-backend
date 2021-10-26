<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $casts = [
        'preferido' => 'boolean',
        'distribuidor' => 'boolean',
        'enabled' => 'boolean',
      ];

    protected $fillable = [
        'razon_social',
        'ruc',
        'direccion',
        'representante_nombre',
        'representante_dni',
        'nro_partida',
        'preferido',
        'distribuidor'
    ];
}
