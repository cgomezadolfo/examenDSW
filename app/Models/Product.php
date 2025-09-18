<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sku',
        'nombre',
        'descripcion_corta',
        'descripcion_larga',
        'imagen_url',
        'precio_neto',
        'precio_venta',
        'stock_actual',
        'stock_minimo',
        'stock_bajo',
        'stock_alto',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'precio_neto' => 'decimal:2',
        'precio_venta' => 'decimal:2',
        'stock_actual' => 'integer',
        'stock_minimo' => 'integer',
        'stock_bajo' => 'integer',
        'stock_alto' => 'integer',
    ];

    /**
     * Validation rules for Product model
     */
    public static function validationRules(): array
    {
        return [
            'sku' => 'required|string|max:50|unique:products,sku',
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'required|string',
            'descripcion_larga' => 'required|string',
            'imagen_url' => 'nullable|url|max:500',
            'precio_neto' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_bajo' => 'required|integer|min:0',
            'stock_alto' => 'required|integer|min:0',
        ];
    }

    /**
     * Calculate precio_venta based on precio_neto (19% IVA)
     */
    public function calculatePrecioVenta(): float
    {
        return round($this->precio_neto * 1.19, 2);
    }

    /**
     * Check if stock is low
     */
    public function isStockLow(): bool
    {
        return $this->stock_actual <= $this->stock_bajo;
    }

    /**
     * Check if stock is high
     */
    public function isStockHigh(): bool
    {
        return $this->stock_actual >= $this->stock_alto;
    }
}
