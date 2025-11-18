<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Session;

class CategoriaController extends Controller
{
    public function index(){
        $categorias = Categoria::all();
        return view("admin.categoria.index", compact("categorias"));
    }

    public function create(){
        return view("admin.categoria.create");
    }
    //guardar informacion 
    public function store(Request $request){
        $categoria = new Categoria($request->all());
        $categoria->save();
        return redirect('admin/categoria');
    }
    public function edit($id){
        $categoria = Categoria::find($id);
        return view("admin.categoria.edit",compact("categoria"));
    }
    public function update(Request $request, $id){
        $categoria =Categoria::findOrFail($id);
        $categoria->fill($request->all());
        $categoria->save();
        return redirect('admin/categoria');
    }
    public function destroy($id){
        $categoria = Categoria::findOrFail($id);
        $categoria -> delete();
        return redirect('l');
    }
    public function show($id){
        Session::put("categoria_id",$id);
        return redirect('admin/producto');
    }
}
