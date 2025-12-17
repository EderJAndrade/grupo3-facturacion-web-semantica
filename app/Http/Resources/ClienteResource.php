<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    public function toArray($request)
    {
        // JSON-LD representation using schema.org Person or Organization
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'identifier' => $this->id,
            'name' => $this->nombre,
            'legalName' => $this->razon_social,
            'email' => $this->email,
            'telephone' => $this->telefono,
            'address' => $this->direccion,
            'url' => route('clientes.show', $this->id),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
