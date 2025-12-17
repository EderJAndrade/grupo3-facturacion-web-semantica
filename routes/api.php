<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ClienteController;
use App\Http\Controllers\API\ProductoController;
use App\Http\Controllers\API\FacturaController;
use App\Http\Controllers\API\DetalleFacturaController;

/*
|--------------------------------------------------------------------------
| API Routes - grupo3 facturación
|--------------------------------------------------------------------------
| Prefijo automático: /api
| Respuestas en JSON-LD (Web Semántica)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return response()->json([
        '@context' => 'https://schema.org',
        '@type' => 'WebAPI',
        'name' => 'API Facturación grupo3',
        'version' => '1.0',
        'description' => 'API REST con JSON-LD desarrollada en Laravel'
    ]);
});

/* CRUD Clientes */
Route::apiResource('clientes', ClienteController::class);

/* CRUD Productos */
Route::apiResource('productos', ProductoController::class);

/* CRUD Facturas */
Route::apiResource('facturas', FacturaController::class);

/* CRUD Detalle Facturas */
Route::apiResource('detalle-facturas', DetalleFacturaController::class);
