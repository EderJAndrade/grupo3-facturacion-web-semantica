<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ClienteResource;
use App\Http\Resources\DetalleFacturaResource;

class FacturaResource extends JsonResource
{
    public function toArray($request)
    {
        // Cargar relaciones si no están cargadas
        $this->loadMissing(['cliente', 'detalle.producto']);

        return [
            '@context' => 'https://schema.org',
            '@type' => 'Invoice',
            'identifier' => $this->id,
            'invoiceNumber' => $this->numero,
            'billingPeriod' => [
                'startDate' => $this->fecha?->format('Y-m-d'),
                'endDate' => $this->fecha?->format('Y-m-d')
            ],
            'customer' => new ClienteResource($this->cliente),
            'paymentDue' => $this->fecha?->addDays(30)?->format('Y-m-d'),
            'totalPaymentDue' => (float)$this->total,
            'tax' => (float)$this->impuesto,
            'subTotal' => (float)$this->sub_total,
            'invoiceItem' => DetalleFacturaResource::collection($this->detalle),
            'url' => route('facturas.show', $this->id),
            'dateCreated' => $this->created_at,
            'dateModified' => $this->updated_at,
        ];
    }
}
