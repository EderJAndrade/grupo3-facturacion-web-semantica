<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = ['numero','cliente_id','fecha','sub_total','impuesto','total','estado'];

    protected $dates = ['fecha'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function detalle()
    {
        return $this->hasMany(DetalleFactura::class);
    }
}
