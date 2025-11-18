<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

//use App\Http\Controllers\Admin\SlideController
/* registrar roles en base datos
use Spatie\Permission\Models\Role;
$role = Role::create(['name' => 'admin']);
$role = Role::create(['name' => 'cliente']);
*/

Route::get('/', [App\Http\Controllers\FontController::class, 'index']);
Route::get('/catalogo', [App\Http\Controllers\FontController::class, 'catalogo']);
Route::get('/catalogo/{producto:slug}', [App\Http\Controllers\FontController::class, 'producto']);

Route::view('/empresa', 'font.empresa'); 
Route::view('/preguntas', 'font.preguntas');
Route::view('/terminos', 'font.terminos');

// RUTAS DEL CARRITO
Route::post('/agregaritem', [App\Http\Controllers\CarritoController::class, 'agregarItem'])->name("agregaritem");
Route::get('/vercarrito', [App\Http\Controllers\CarritoController::class, 'verCarrito'])->name("vercarrito");
Route::get('/incrementar/{id}', [App\Http\Controllers\CarritoController::class, 'incrementarCantidad'])->name("incrementarcantidad");
Route::get('/decrementar/{id}', [App\Http\Controllers\CarritoController::class, 'decrementarCantidad'])->name("decrementarcantidad");
Route::get('/eliminaritem/{id}', [App\Http\Controllers\CarritoController::class, 'eliminarItem'])->name("eliminaritem");
Route::get('/eliminarcarrito', [App\Http\Controllers\CarritoController::class, 'eliminarCarrito'])->name("eliminarcarrito");
Route::get('/confirmarcarrito', [App\Http\Controllers\CarritoController::class, 'confirmarCarrito'])->name("confirmarcarrito");

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Grupo de rutas para ADMIN
Route::group(['prefix' => 'admin', 'middleware' => ['auth','role:admin']], function() {
    /* Rutas para el Administrador */
    Route::resource('categoria', App\Http\Controllers\Admin\CategoriaController::class, ["as"=>"admin"]);
    Route::resource('producto', App\Http\Controllers\Admin\ProductoController::class, ["as"=>"admin"]);
    Route::resource('precio', App\Http\Controllers\Admin\PrecioController::class, ["as"=>"admin"]);
    Route::resource('pedido', App\Http\Controllers\Admin\PedidoController::class, ["as"=>"admin"]);
    Route::resource('user', App\Http\Controllers\Admin\UserController::class, ["as"=>"admin"]);

    /* Panel de administración de usuarios y roles */
    Route::get('/usuarios', [UserController::class, 'index'])->name('admin.usuarios.index');
    Route::post('/usuarios/{id}/rol', [UserController::class, 'updateRole'])->name('admin.usuarios.updateRole');
});

// Grupo de rutas para CLIENTE
Route::group(['prefix' => 'cliente', 'middleware' => ['auth','role:cliente']], function() {
    /* Rutas exclusivas para cliente */
});
