@extends('layouts.app')

@section('title', 'Detalles Cliente - VentasFix')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Clientes</a></li>
                    <li class="breadcrumb-item active">Detalles</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Detalles del Cliente</h5>
                    <div class="btn-group">
                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-info btn-sm">
                            <i class="ti ti-pencil me-2"></i>Editar
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="ti ti-trash me-2"></i>Eliminar
                        </button>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <!-- Avatar y Información Básica -->
                        <div class="col-md-4">
                            <div class="text-center mb-4">
                                <div class="avatar avatar-xl mx-auto mb-3">
                                    <span class="avatar-initial rounded-circle bg-label-info fs-2">
                                        {{ strtoupper(substr($client->nombre, 0, 2)) }}
                                    </span>
                                </div>
                                <h4 class="mb-1">{{ $client->nombre }}</h4>
                                <span class="badge bg-label-success">Cliente Activo</span>
                                <div class="mt-2">
                                    <span class="badge bg-label-secondary">{{ $client->rut }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Información Detallada -->
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">RUT</label>
                                    <p class="form-control-plaintext">
                                        <span class="badge bg-label-primary fs-6">{{ $client->rut }}</span>
                                    </p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">Email</label>
                                    <p class="form-control-plaintext">
                                        <i class="ti ti-mail me-2 text-primary"></i>{{ $client->email }}
                                    </p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">Teléfono</label>
                                    <p class="form-control-plaintext">
                                        @if($client->telefono)
                                            <i class="ti ti-phone me-2 text-success"></i>{{ $client->telefono }}
                                        @else
                                            <span class="text-muted">No registrado</span>
                                        @endif
                                    </p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">Ciudad</label>
                                    <p class="form-control-plaintext">
                                        @if($client->ciudad)
                                            <i class="ti ti-map-pin me-2 text-info"></i>{{ $client->ciudad }}
                                        @else
                                            <span class="text-muted">No especificada</span>
                                        @endif
                                    </p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">Región</label>
                                    <p class="form-control-plaintext">
                                        @if($client->region)
                                            <span class="badge bg-label-info">{{ $client->region }}</span>
                                        @else
                                            <span class="text-muted">No especificada</span>
                                        @endif
                                    </p>
                                </div>

                                @if($client->direccion)
                                <div class="col-12 mb-4">
                                    <label class="form-label text-muted">Dirección</label>
                                    <p class="form-control-plaintext">
                                        <i class="ti ti-map me-2 text-warning"></i>{{ $client->direccion }}
                                    </p>
                                </div>
                                @endif

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">Fecha de Registro</label>
                                    <p class="form-control-plaintext">
                                        <i class="ti ti-calendar me-2 text-success"></i>{{ $client->created_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">Última Actualización</label>
                                    <p class="form-control-plaintext">
                                        <i class="ti ti-clock me-2 text-secondary"></i>{{ $client->updated_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Estadísticas del Cliente -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Información de Contacto</h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-3">
                                                    <span class="avatar-initial rounded bg-label-primary">
                                                        <i class="ti ti-id"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">#{{ $client->id }}</h6>
                                                    <small class="text-muted">ID del Cliente</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-3">
                                                    <span class="avatar-initial rounded bg-label-success">
                                                        <i class="ti ti-calendar-plus"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $client->created_at->diffForHumans() }}</h6>
                                                    <small class="text-muted">Cliente desde</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-3">
                                                    <span class="avatar-initial rounded bg-label-info">
                                                        <i class="ti ti-building"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Empresa</h6>
                                                    <small class="text-muted">Tipo de cliente</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información de contacto rápida -->
                    @if($client->email || $client->telefono)
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card border-primary">
                                <div class="card-body">
                                    <h6 class="card-title text-primary">Contacto Rápido</h6>
                                    <div class="d-flex gap-3">
                                        @if($client->email)
                                            <a href="mailto:{{ $client->email }}" class="btn btn-outline-primary btn-sm">
                                                <i class="ti ti-mail me-2"></i>Enviar Email
                                            </a>
                                        @endif
                                        @if($client->telefono)
                                            <a href="tel:{{ $client->telefono }}" class="btn btn-outline-success btn-sm">
                                                <i class="ti ti-phone me-2"></i>Llamar
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">
                            <i class="ti ti-arrow-left me-2"></i>Volver a Clientes
                        </a>
                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-info">
                            <i class="ti ti-pencil me-2"></i>Editar Cliente
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="avatar avatar-lg mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-label-danger">
                            <i class="ti ti-trash ti-lg"></i>
                        </span>
                    </div>
                    <h4 class="mb-2">¿Eliminar Cliente?</h4>
                    <p class="text-muted mb-4">
                        Estás a punto de eliminar a <strong>{{ $client->nombre }}</strong>. 
                        Esta acción no se puede deshacer.
                    </p>
                    <div class="alert alert-warning">
                        <i class="ti ti-alert-triangle me-2"></i>
                        Se perderán todos los datos de contacto y el historial del cliente.
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar Cliente</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection