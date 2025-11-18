<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\JsonController;

Route::post('register', [UserController::class,'register']);
Route::post('login', [UserController::class,'login']);

 Route::group(['middleware'=> ["auth:sanctum"]],function(){
 Route::get('logout', [UserController::class,'logout']);
 Route::post('categorias', [JsonController::class,'categorias']);
 Route::post('productos', [JsonController::class,'productos']);
 Route::post('precios', [JsonController::class,'precios']);
 Route::post('pedido', [JsonController::class,'pedido']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
