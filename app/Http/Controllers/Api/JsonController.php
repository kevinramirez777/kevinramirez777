<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Precio;
use App\Models\Pedido;
use App\Models\Detalle;

//use Illuminate\Support\Facades\Hash;

class JsonController extends Controller
{
    public function categorias(){
        $categorias = Categoria::all();
        return response()->json($categorias,200);
    }
    public function productos(Request $request){
        $productos = Producto::whereCategoria_id($request->categoria_id)->get();
        return response()->json($productos,200);
    }
     public function precios(Request $request){
        $precios = Precio::whereProducto_id($request->producto_id)->get();
        return response()->json($precios,200);
    }
    public function pedido(Request $request)
    {
    $data = [
        "success" => false,
        "mensaje" => "Tu pedido no ha sido procesado "
    ];

    $pedido = new Pedido();
    $pedido->subtotal = $request->subtotal;
    $pedido->impuesto = $request->impuesto;
    $pedido->total = $request->total;
    $pedido->fechapedido = date("Y-m-d H:i:s");
    $pedido->procedencia = "app";
    $pedido->estado = "nuevo";
    $pedido->user_id = auth()->user()->id;
    $pedido->save();
     
    foreach ($request->values as $key => $value) {
     foreach ($value as $item) {
        $detalle = new Detalle();
        $detalle->precio       = $item['precio'];
        $detalle->cantidad     = $item['cantidad'];
        $detalle->importe      = $item['importe'];
        $detalle->medida       = ($item['tamano'] != NULL) ? $item['tamano'] : "";
        $detalle->producto_id  = $item['producto_id'];
        $detalle->pedido_id    = $pedido->id;
        $detalle->save();
     }
    }


    $data = [
        "success" => true,
        "mensaje" => "Tu pedido ha sido procesado "
    ];

    return response()->json($data, 200);
    }
}
