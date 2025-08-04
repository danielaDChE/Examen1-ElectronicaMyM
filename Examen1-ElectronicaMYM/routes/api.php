<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductoController;

// Versión API
Route::prefix('v1')->group(function () {
    // Autenticación
    Route::post('/register', [AuthController::class, 'register'])->name('api.register');
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');

    // Rutas protegidas
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', fn (Request $request) => $request->user())->name('api.user');
        Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
        
        // CRUDs con nombres de rutas
        Route::apiResource('marcas', MarcaController::class)
            ->names([
                'index' => 'api.marcas.index',
                'store' => 'api.marcas.store',
                'show' => 'api.marcas.show',
                'update' => 'api.marcas.update',
                'destroy' => 'api.marcas.destroy'
            ]);
            
        Route::apiResource('productos', ProductoController::class)
            ->names([
                'index' => 'api.productos.index',
                'store' => 'api.productos.store',
                'show' => 'api.productos.show',
                'update' => 'api.productos.update',
                'destroy' => 'api.productos.destroy'
            ]);
    });
});