<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Precio;
use Illuminate\Support\Str;
use Session;

class PrecioController extends Controller
{
    public function index(){
        if(Session::get("producto_id")!=null)
        {
            $precios = Precio::whereProducto_id(Session::get("producto_id"))->get();
            $producto = Producto::find(Session::get("producto_id"));
        return view("admin.precio.index", compact("precios","producto"));
        }
    }

    public function create(){
        return view('admin.precio.create');
    }


    public function store(Request $request){
        $precio = new Precio($request->all());
        $precio->producto_id = Session::get("producto_id");
        $precio->save();
       return redirect('admin/precio');
    }

    public function edit($id){
        $precio   = Precio::find($id);
        return view('admin.precio.edit',compact("precio"));
    }
    public function update(Request $request, $id){
        $precio       = Precio::findOrFail($id);
        $precio->fill($request->all());
        $precio->save();
        return redirect('admin/precio');
    }
    public function destroy($id){
        $precio   = Precio::findOrFail($id);
        $precio->delete();
        return redirect('admin/precio');
    }
    public function show($id){
        Session::put("producto_id",$id);
        return redirect('admin/precio');
    }
}
