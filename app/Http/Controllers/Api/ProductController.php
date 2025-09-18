<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(): JsonResponse
    {
        $products = Product::paginate(15);

        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria' => 'required|string|max:100',
            'codigo_barras' => 'nullable|string|max:50|unique:products,codigo_barras',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $product = Product::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Producto creado exitosamente',
            'data' => $product
        ], 201);
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $product
        ], 200);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria' => 'required|string|max:100',
            'codigo_barras' => 'nullable|string|max:50|unique:products,codigo_barras,' . $product->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $product->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Producto actualizado exitosamente',
            'data' => $product->fresh()
        ], 200);
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Producto eliminado exitosamente'
        ], 200);
    }

    /**
     * Search products by name, category or barcode.
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q', '');
        
        if (empty($query)) {
            return $this->index();
        }

        $products = Product::where('nombre', 'LIKE', "%{$query}%")
                           ->orWhere('categoria', 'LIKE', "%{$query}%")
                           ->orWhere('codigo_barras', 'LIKE', "%{$query}%")
                           ->orWhere('descripcion', 'LIKE', "%{$query}%")
                           ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $products,
            'query' => $query
        ], 200);
    }

    /**
     * Get products with low stock.
     */
    public function lowStock(): JsonResponse
    {
        $products = Product::where('stock', '<=', 5)->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }

    /**
     * Get products by category.
     */
    public function byCategory(Request $request): JsonResponse
    {
        $category = $request->get('categoria', '');
        
        if (empty($category)) {
            return response()->json([
                'success' => false,
                'message' => 'Parámetro categoria es requerido'
            ], 400);
        }

        $products = Product::where('categoria', $category)->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $products,
            'categoria' => $category
        ], 200);
    }

    /**
     * Update product stock.
     */
    public function updateStock(Request $request, Product $product): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'stock' => 'required|integer|min:0',
            'operation' => 'required|in:set,add,subtract',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $newStock = $request->stock;
        $operation = $request->operation;

        switch ($operation) {
            case 'add':
                $newStock = $product->stock + $request->stock;
                break;
            case 'subtract':
                $newStock = max(0, $product->stock - $request->stock);
                break;
            case 'set':
            default:
                $newStock = $request->stock;
                break;
        }

        $product->update(['stock' => $newStock]);

        return response()->json([
            'success' => true,
            'message' => 'Stock actualizado exitosamente',
            'data' => [
                'product' => $product->fresh(),
                'previous_stock' => $product->getOriginal('stock'),
                'new_stock' => $newStock,
                'operation' => $operation
            ]
        ], 200);
    }
}