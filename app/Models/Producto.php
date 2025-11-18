<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;
    //public $timestamps = false;
    protected $fillable = [
        'slug',
        'nombre',
        'descripcion',
        'urlfoto',
        'precio',
        'stock',
        'presentacion',
        'publicado', //BOOLEAN
        'orden',
        'visitas',
        'portada', //BOOLEAn
        'categoria_id'
    ];
    //Deficion de relacion con Categoria
    public function categoria(){
        return $this->belongsTo(Categoria::class);
      
    }

     //Relacion con precio con hasMany
     public function precios(){  
        return $this->hasMany(Precio::class);
    }
}
