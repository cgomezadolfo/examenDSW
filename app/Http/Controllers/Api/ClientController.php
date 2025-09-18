<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of clients.
     */
    public function index(): JsonResponse
    {
        $clients = Client::paginate(15);

        return response()->json([
            'success' => true,
            'data' => $clients
        ], 200);
    }

    /**
     * Store a newly created client in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'rut' => 'required|string|max:12|unique:clients,rut',
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clients,email',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string',
            'ciudad' => 'nullable|string|max:100',
            'region' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $client = Client::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Cliente creado exitosamente',
            'data' => $client
        ], 201);
    }

    /**
     * Display the specified client.
     */
    public function show(Client $client): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $client
        ], 200);
    }

    /**
     * Update the specified client in storage.
     */
    public function update(Request $request, Client $client): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'rut' => 'required|string|max:12|unique:clients,rut,' . $client->id,
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clients,email,' . $client->id,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string',
            'ciudad' => 'nullable|string|max:100',
            'region' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $client->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Cliente actualizado exitosamente',
            'data' => $client->fresh()
        ], 200);
    }

    /**
     * Remove the specified client from storage.
     */
    public function destroy(Client $client): JsonResponse
    {
        $client->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cliente eliminado exitosamente'
        ], 200);
    }

    /**
     * Search clients by name, email or RUT.
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q', '');
        
        if (empty($query)) {
            return $this->index();
        }

        $clients = Client::where('nombre', 'LIKE', "%{$query}%")
                         ->orWhere('email', 'LIKE', "%{$query}%")
                         ->orWhere('rut', 'LIKE', "%{$query}%")
                         ->orWhere('ciudad', 'LIKE', "%{$query}%")
                         ->orWhere('region', 'LIKE', "%{$query}%")
                         ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $clients,
            'query' => $query
        ], 200);
    }

    /**
     * Get clients by region.
     */
    public function byRegion(Request $request): JsonResponse
    {
        $region = $request->get('region', '');
        
        if (empty($region)) {
            return response()->json([
                'success' => false,
                'message' => 'Parámetro region es requerido'
            ], 400);
        }

        $clients = Client::where('region', $region)->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $clients,
            'region' => $region
        ], 200);
    }

    /**
     * Get clients by city.
     */
    public function byCity(Request $request): JsonResponse
    {
        $city = $request->get('ciudad', '');
        
        if (empty($city)) {
            return response()->json([
                'success' => false,
                'message' => 'Parámetro ciudad es requerido'
            ], 400);
        }

        $clients = Client::where('ciudad', $city)->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $clients,
            'ciudad' => $city
        ], 200);
    }

    /**
     * Get statistics about clients.
     */
    public function statistics(): JsonResponse
    {
        $stats = [
            'total_clients' => Client::count(),
            'clients_by_region' => Client::select('region')
                                        ->selectRaw('count(*) as total')
                                        ->whereNotNull('region')
                                        ->groupBy('region')
                                        ->get(),
            'clients_by_city' => Client::select('ciudad')
                                      ->selectRaw('count(*) as total')
                                      ->whereNotNull('ciudad')
                                      ->groupBy('ciudad')
                                      ->orderByDesc('total')
                                      ->limit(10)
                                      ->get(),
            'recent_clients' => Client::orderByDesc('created_at')
                                     ->limit(5)
                                     ->get(['id', 'nombre', 'email', 'ciudad', 'created_at'])
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ], 200);
    }
}