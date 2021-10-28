<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialDci extends Model
{
    use HasFactory;

    protected $casts = [
        'enabled' => 'boolean',
      ];

    protected $fillable = [
        'principio_activo',
        'concentracion',
        'forma_farmaceutica',
        'dci'
    ];
}
