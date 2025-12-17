<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'sku' => $this->codigo,
            'name' => $this->nombre,
            'description' => $this->descripcion,
            'offers' => [
                '@type' => 'Offer',
                'priceCurrency' => 'USD',
                'price' => (float)$this->precio_unitario,
                'availability' => $this->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock'
            ],
            'inventoryLevel' => $this->stock,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
