<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductoController;

// Autenticación (Público)
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login']);

//Rutas Protegidas (Requieren token Sanctum)

Route::middleware('auth:sanctum')->group(function () {
    // Ruta para obtener datos del usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Logout (elimina el token actual)
    Route::post('/logout', [AuthController::class, 'logout']);

// CRUD Marcas
    //Route::apiResource('marcas', MarcaController::class);

// CRUD Productos

   // Route::apiResource('productos', ProductoController::class);
});