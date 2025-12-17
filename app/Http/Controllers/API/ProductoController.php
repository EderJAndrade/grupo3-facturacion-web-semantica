<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Http\Resources\ProductoResource;

class ProductoController extends Controller
{
    public function index()
    {
        return ProductoResource::collection(Producto::paginate(15));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo'=>'required|string|unique:productos,codigo',
            'nombre'=>'required|string',
            'descripcion'=>'nullable|string',
            'precio_unitario'=>'required|numeric',
            'stock'=>'integer',
        ]);

        $producto = Producto::create($data);
        return new ProductoResource($producto);
    }

    public function show(Producto $producto)
    {
        return new ProductoResource($producto);
    }

    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate([
            'codigo'=>'sometimes|required|string|unique:productos,codigo,'.$producto->id,
            'nombre'=>'sometimes|required|string',
            'descripcion'=>'nullable|string',
            'precio_unitario'=>'sometimes|required|numeric',
            'stock'=>'integer',
        ]);

        $producto->update($data);
        return new ProductoResource($producto);
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return response()->json(['message'=>'Producto eliminado.'], 200);
    }
}


