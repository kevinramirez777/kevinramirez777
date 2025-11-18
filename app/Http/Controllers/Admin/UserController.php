<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index(){
        $users = User::role('cliente')->get();
        return view("admin.user.index", compact("users"));
    }
    public function updateRole(Request $request, $id)
{
    $request->validate([
        'role' => 'required|string|exists:roles,name',
    ]);

    $user = User::findOrFail($id);

    // Elimina roles anteriores y asigna el nuevo
    $user->syncRoles([$request->role]);

    return redirect()->route('admin.usuarios.index')->with('success', 'Rol actualizado correctamente');
}
    public function create(){
        return view("admin.user.create");
    }
    public function edit($id){
        $user = User::find($id);
        return view("admin.user.edit",compact("user"));
    }
    public function store(Request $request)
{
    $user = new User();
    $user->name      = $request->name;
    $user->celular   = $request->celular;
    $user->direccion = $request->direccion;

    // Generar email ficticio único
    $user->email     = Str::slug($request->name).uniqid().'@example.com';
    // Generar password aleatorio
    $user->password  = bcrypt(Str::random(8));

    $user->assignRole('cliente'); // si usas spatie/roles
    $user->save();

    return redirect('admin/user')->with('success','Cliente creado correctamente');
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    $user->name      = $request->name;
    $user->celular   = $request->celular;
    $user->direccion = $request->direccion;

    $user->save();
    return redirect('admin/user')->with('success','Cliente actualizado correctamente');
}

    public function destroy($id){
        $user = User::findOrFail($id);
        $user -> delete();
        return redirect('admin/user');
    }
}
