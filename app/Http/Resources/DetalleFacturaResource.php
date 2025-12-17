<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductoResource;

class DetalleFacturaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            '@type' => 'InvoiceLineItem',
            'product' => new ProductoResource($this->whenLoaded('producto') ?: $this->producto),
            'quantity' => (int)$this->cantidad,
            'unitPrice' => (float)$this->precio_unitario,
            'lineTotal' => (float)$this->total_linea,
        ];
    }
}
