<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|string|max:50|unique:products,sku',
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'required|string',
            'descripcion_larga' => 'nullable|string',
            'imagen_url' => 'nullable|string|max:500',
            'precio_neto' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_bajo' => 'required|integer|min:0',
            'stock_alto' => 'required|integer|min:0',
        ]);

        // Calcular precio de venta (precio neto + IVA 19%)
        $data = $request->all();
        $data['precio_venta'] = $data['precio_neto'] * 1.19;

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'sku' => 'required|string|max:50|unique:products,sku,' . $product->id,
            'nombre' => 'required|string|max:255',
            'descripcion_corta' => 'required|string',
            'descripcion_larga' => 'nullable|string',
            'imagen_url' => 'nullable|string|max:500',
            'precio_neto' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'stock_bajo' => 'required|integer|min:0',
            'stock_alto' => 'required|integer|min:0',
        ]);

        // Calcular precio de venta (precio neto + IVA 19%)
        $data = $request->all();
        $data['precio_venta'] = $data['precio_neto'] * 1.19;

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
