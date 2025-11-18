<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $data=["success"=>false,"mensaje"=>"No se pudo registrar"];
         $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'celular' => $request->celular,
            'direccion' => $request->direccion,
            'password' => Hash::make($request->password),
        ]); 
        $user->assignRole("cliente");
        //$data=["success"=>true,"mensaje"=>"Registro Exitoso"];
        //return response()->json($data, 200);
        return $this->login($request);
    }

    public function login(Request $request){

        $data=["success"=>false,"mensaje"=>"Usuario no registrado"];
        
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = User::whereEmail($request->email)->first();
        if(!empty($user)){
          $data=["success"=>false,"mensaje"=>"Password Incorrecto"];
         if(Hash::check($request->password, $user->password)){
             $accessToken = $user->createToken("auth_token")->plainTextToken;
             $data=[
               "success"=>true,
               "mensaje"=>"Usuario Logueado",
               "user_id"=>$user->id,
               "access_token"=>$accessToken
             ];
          }
        }
        return response()->json($data, 200);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        $data=[
             "success"=>true,
             "mensaje"=>"Logout",
        ];
        return response()->json($data, 200);
      }
}
