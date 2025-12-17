<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetalleFactura;
use App\Http\Resources\DetalleFacturaResource;

class DetalleFacturaController extends Controller
{
    public function index()
    {
        return DetalleFacturaResource::collection(DetalleFactura::with('producto')->paginate(20));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'factura_id'=>'required|exists:facturas,id',
            'producto_id'=>'required|exists:productos,id',
            'cantidad'=>'required|integer|min:1',
            'precio_unitario'=>'required|numeric',
        ]);

        $data['total_linea'] = $data['cantidad'] * $data['precio_unitario'];
        $detalle = DetalleFactura::create($data);

        return new DetalleFacturaResource($detalle->load('producto'));
    }

    public function show(DetalleFactura $detalle)
    {
        return new DetalleFacturaResource($detalle->load('producto'));
    }

    public function update(Request $request, DetalleFactura $detalle)
    {
        $data = $request->validate([
            'cantidad'=>'sometimes|required|integer|min:1',
            'precio_unitario'=>'sometimes|required|numeric',
        ]);
        if(isset($data['cantidad']) && isset($data['precio_unitario'])){
            $data['total_linea'] = $data['cantidad'] * $data['precio_unitario'];
        } elseif(isset($data['cantidad'])){
            $data['total_linea'] = $data['cantidad'] * $detalle->precio_unitario;
        } elseif(isset($data['precio_unitario'])){
            $data['total_linea'] = $detalle->cantidad * $data['precio_unitario'];
        }
        $detalle->update($data);
        return new DetalleFacturaResource($detalle->load('producto'));
    }

    public function destroy(DetalleFactura $detalle)
    {
        $detalle->delete();
        return response()->json(['message'=>'Detalle eliminado.'], 200);
    }
}
