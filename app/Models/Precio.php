<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Precio extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
     'nombre',
     'precio',
     'producto_id'
    ];
    
    //Deficion de relacion con Categoria
    public function producto(){
    return $this->belongsTo(Producto::class);
  
     }
     
}
 