<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialRubro extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $casts = [
        'enabled' => 'boolean',
      ];

    protected $fillable = [
        'rubro',
    ];
}
