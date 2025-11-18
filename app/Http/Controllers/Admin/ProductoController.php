<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Str;
use Session;

class ProductoController extends Controller
{
    public function index(){
        if(Session::get("categoria_id")!=null)
        {
            $productos= Producto::whereCategoria_id(Session::get("categoria_id"))->get();
            $categoria = Categoria::find(Session::get("categoria_id"));
        return view("admin.producto.index", compact("productos","categoria"));
        }
    }

    public function create(){
        $categorias = Categoria::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('admin.producto.create',compact("categorias"));
    }

    public function store(Request $request){
        $producto = new Producto($request->all());
        //Tratamiento de imagenes
        if($request->hasFile('urlfoto')){
            $imagen         = $request->file("urlfoto");
            $nombreimagen   = Str::slug($request->name).".".$imagen->guessExtension();
            $ruta=public_path('/img/');
            copy($imagen->getRealPath(), $ruta.$nombreimagen);
            $producto->urlfoto = $nombreimagen;
       }
       //fin tratamiento imagenes
       $producto->publicado = $request->publicado ? 1 : 0;
       $producto->portada   = $request->portada   ? 1 : 0;
       $producto->slug = Str::slug($request->$nombreimagen);
       $producto->categoria_id = Session::get("categoria_id");
       $producto->save();
       return redirect('admin/producto');
    }

  public function edit($id)
{
    $producto   = Producto::find($id);
    $categorias = Categoria::orderBy('nombre','ASC')->get();

    return view('admin.producto.edit', compact('producto', 'categorias'));
}

   public function update(Request $request, $id){
    $producto        = Producto::find($id);
    $urlfotoanterior = $producto->urlfoto;
    $producto->fill($request->all());

    // Tratamiento de imagenes
    if($request->hasFile('urlfoto')){
        // eliminar la anterior si existe
        $rutaAnterior = public_path('/img/'.$urlfotoanterior);
        if(file_exists($rutaAnterior) && $urlfotoanterior != null){ 
            unlink($rutaAnterior); 
        }

        $imagen   = $request->file("urlfoto");
        // nombre único para evitar sobrescribir
        $nombreimagen  = Str::slug($producto->nombre).'-'.uniqid().'.'.$imagen->guessExtension();
        $ruta = public_path("/img/");
        $imagen->move($ruta, $nombreimagen);

        $producto->urlfoto = $nombreimagen;
    }
    // fin tratamiento de imagenes

    $producto->publicado = $request->publicado ? 1 : 0;
    $producto->portada   = $request->portada ? 1 : 0;
    $producto->slug      = Str::slug($producto->nombre);
    $producto->save();

    return redirect('admin/producto');
}

    public function destroy($id){
        $producto   = Producto::findOrFail($id);
        $rutaAnterior = public_path("/img/".$producto->urlfoto);
        if((file_exists($rutaAnterior)) && ($producto->urlfoto!=null)){ unlink (realpath($rutaAnterior)); }
        $producto->delete();
        return redirect('admin/producto');
    }
    public function show($id){
        Session::put("producto_id",$id);
        return redirect('admin/precio');
    }
   /* public function show($id){
        Session::put("categoria_id",$id);
        return redirect('admin/producto');
    }*/
}
