@extends('layouts.app')

@section('title', 'Gestión de Clientes - VentasFix')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Gestión de Clientes</h5>
                    <a href="{{ route('clients.create') }}" class="btn btn-info">
                        <i class="ti ti-plus me-2"></i>Nuevo Cliente
                    </a>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Razón Social</th>
                                    <th>RUT Empresa</th>
                                    <th>Contacto</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($clients as $client)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm me-3">
                                                    <span class="avatar-initial rounded-circle bg-label-info">
                                                        {{ strtoupper(substr($client->razon_social, 0, 2)) }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $client->razon_social }}</h6>
                                                    <small class="text-muted">{{ $client->rubro }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-label-secondary">{{ $client->rut_empresa }}</span>
                                        </td>
                                        <td>{{ $client->nombre_contacto }}</td>
                                        <td>{{ $client->email_contacto }}</td>
                                        <td>
                                            @if($client->telefono)
                                                <i class="ti ti-phone me-1 text-success"></i>{{ $client->telefono }}
                                            @else
                                                <span class="text-muted">No registrado</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('clients.show', $client) }}">
                                                        <i class="ti ti-eye me-2"></i>Ver Detalles
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('clients.edit', $client) }}">
                                                        <i class="ti ti-pencil me-2"></i>Editar
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger" 
                                                                onclick="return confirm('¿Estás seguro de eliminar este cliente?')">
                                                            <i class="ti ti-trash me-2"></i>Eliminar
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="empty-state">
                                                <i class="ti ti-users ti-5x text-muted mb-3"></i>
                                                <h5 class="text-muted">No hay clientes registrados</h5>
                                                <p class="text-muted">Comienza agregando el primer cliente al sistema</p>
                                                <a href="{{ route('clients.create') }}" class="btn btn-info">
                                                    <i class="ti ti-plus me-2"></i>Crear Cliente
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($clients->hasPages())
                        <div class="row mt-4">
                            <div class="col">
                                <div class="d-flex justify-content-center">
                                    {{ $clients->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection