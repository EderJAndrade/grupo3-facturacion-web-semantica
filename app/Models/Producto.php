<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['codigo','nombre','descripcion','precio_unitario','stock'];

    public function detalleFacturas()
    {
        return $this->hasMany(DetalleFactura::class);
    }
}


