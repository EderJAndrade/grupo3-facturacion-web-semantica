<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\DetalleFactura;
use App\Http\Resources\FacturaResource;

class FacturaController extends Controller
{
    public function index()
    {
        return FacturaResource::collection(Factura::with('cliente')->paginate(15));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'numero'=>'required|string|unique:facturas,numero',
            'cliente_id'=>'required|exists:clientes,id',
            'fecha'=>'required|date',
            'sub_total'=>'required|numeric',
            'impuesto'=>'required|numeric',
            'total'=>'required|numeric',
            'detalle'=>'required|array|min:1',
            'detalle.*.producto_id'=>'required|exists:productos,id',
            'detalle.*.cantidad'=>'required|integer|min:1',
            'detalle.*.precio_unitario'=>'required|numeric',
        ]);

        $factura = Factura::create([
            'numero'=>$data['numero'],
            'cliente_id'=>$data['cliente_id'],
            'fecha'=>$data['fecha'],
            'sub_total'=>$data['sub_total'],
            'impuesto'=>$data['impuesto'],
            'total'=>$data['total'],
            'estado'=>'pendiente'
        ]);

        foreach ($data['detalle'] as $item) {
            DetalleFactura::create([
                'factura_id'=>$factura->id,
                'producto_id'=>$item['producto_id'],
                'cantidad'=>$item['cantidad'],
                'precio_unitario'=>$item['precio_unitario'],
                'total_linea'=> $item['cantidad'] * $item['precio_unitario'],
            ]);
        }

        $factura->load('cliente','detalle.producto');

        return new FacturaResource($factura);
    }

    public function show(Factura $factura)
    {
        $factura->load('cliente','detalle.producto');
        return new FacturaResource($factura);
    }

    public function update(Request $request, Factura $factura)
    {
        $data = $request->validate([
            'numero'=>'sometimes|required|string|unique:facturas,numero,'.$factura->id,
            'cliente_id'=>'sometimes|required|exists:clientes,id',
            'fecha'=>'sometimes|required|date',
            'sub_total'=>'sometimes|required|numeric',
            'impuesto'=>'sometimes|required|numeric',
            'total'=>'sometimes|required|numeric',
            'estado'=>'sometimes|required|string',
        ]);

        $factura->update($data);
        $factura->load('cliente','detalle.producto');

        return new FacturaResource($factura);
    }

    public function destroy(Factura $factura)
    {
        $factura->delete();
        return response()->json(['message'=>'Factura eliminada.'], 200);
    }
}
