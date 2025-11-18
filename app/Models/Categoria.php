<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'slug',
        'nombre'
    ];

    //Relacion con producto con hasMany
    public function productos(){  
        return $this->hasMany(Producto::class);
    }
}
