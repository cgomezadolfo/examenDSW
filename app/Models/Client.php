<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rut_empresa',
        'rubro',
        'razon_social',
        'telefono',
        'direccion',
        'nombre_contacto',
        'email_contacto',
    ];

    /**
     * Validation rules for Client model
     */
    public static function validationRules(): array
    {
        return [
            'rut_empresa' => 'required|string|max:12|unique:clients,rut_empresa',
            'rubro' => 'required|string|max:150',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string',
            'nombre_contacto' => 'required|string|max:200',
            'email_contacto' => 'required|email|max:100',
        ];
    }

    /**
     * Format RUT empresa for display
     */
    public function getFormattedRutAttribute(): string
    {
        $rut = $this->rut_empresa;
        if (strlen($rut) >= 2) {
            return substr($rut, 0, -1) . '-' . substr($rut, -1);
        }
        return $rut;
    }
}
