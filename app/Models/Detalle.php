<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Detalle extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
    'precio',
    'cantidad',
    'importe',
    'medida',
    'producto_id',
    'pedido_id'
    ];
    public function pedido(){
        return $this->belongsTo(Pedido::class);
      
    }
    public function producto(){
        return $this->belongsTo(Producto::class);
      
    }
}
