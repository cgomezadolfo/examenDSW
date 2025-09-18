<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::paginate(10);
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rut_empresa' => 'required|string|max:12|unique:clients,rut_empresa',
            'rubro' => 'required|string|max:150',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string',
            'nombre_contacto' => 'required|string|max:200',
            'email_contacto' => 'required|email|max:100|unique:clients,email_contacto',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Cliente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'rut_empresa' => 'required|string|max:12|unique:clients,rut_empresa,' . $client->id,
            'rubro' => 'required|string|max:150',
            'razon_social' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string',
            'nombre_contacto' => 'required|string|max:200',
            'email_contacto' => 'required|email|max:100|unique:clients,email_contacto,' . $client->id,
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Cliente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
