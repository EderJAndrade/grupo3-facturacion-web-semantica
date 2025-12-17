<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Http\Resources\ClienteResource;

class ClienteController extends Controller
{
    public function index()
    {
        return ClienteResource::collection(Cliente::paginate(15));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'=>'required|string|max:255',
            'razon_social'=>'nullable|string|max:255',
            'email'=>'nullable|email',
            'telefono'=>'nullable|string|max:50',
            'direccion'=>'nullable|string',
        ]);

        $cliente = Cliente::create($data);
        return new ClienteResource($cliente);
    }

    public function show(Cliente $cliente)
    {
        return new ClienteResource($cliente);
    }

    public function update(Request $request, Cliente $cliente)
    {
        $data = $request->validate([
            'nombre'=>'sometimes|required|string|max:255',
            'razon_social'=>'nullable|string|max:255',
            'email'=>'nullable|email',
            'telefono'=>'nullable|string|max:50',
            'direccion'=>'nullable|string',
        ]);

        $cliente->update($data);
        return new ClienteResource($cliente);
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return response()->json(['message'=>'Cliente eliminado.'], 200);
    }
}
