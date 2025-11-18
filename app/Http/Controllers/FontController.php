<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class FontController extends Controller
{
    public function index(){
        $productos = Producto::wherePortada(true)->get();
        return view("welcome", compact("productos"));
    }
    public function catalogo(){
        $categorias = Categoria::all();
        return view("font.catalogo", compact("categorias"));
    }
    public function producto(Producto $producto){
        $producto->increment("visitas");
        return view("font.producto", compact("producto"));
    }
}
