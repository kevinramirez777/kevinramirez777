<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use Session;

class PedidoController extends Controller
{
    public function index(){
        $pedidos = Pedido::orderByDesc('updated_at')->get();
        return view('admin.pedido.index',compact("pedidos"));
    }

    public function edit($id){
        $pedido = Pedido::find($id);
        return view("admin.pedido.edit",compact("pedido"));
    }
    public function update(Request $request, $id){
        $pedido =Pedido::findOrFail($id);
        $pedido->fill($request->all());
        $pedido->save();
        return redirect('admin/pedido');
    }
}
