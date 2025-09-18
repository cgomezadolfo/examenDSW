@extends('layouts.app')

@section('title', 'Detalles Usuario - VentasFix')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
                    <li class="breadcrumb-item active">Detalles</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Detalles del Usuario</h5>
                    <div class="btn-group">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-sm">
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
                                    <span class="avatar-initial rounded-circle bg-label-primary fs-2">
                                        {{ strtoupper(substr($user->nombre, 0, 1)) }}{{ strtoupper(substr($user->apellido, 0, 1)) }}
                                    </span>
                                </div>
                                <h4 class="mb-1">{{ $user->nombre }} {{ $user->apellido }}</h4>
                                <span class="badge bg-label-success">Usuario Activo</span>
                            </div>
                        </div>

                        <!-- Información Detallada -->
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">RUT</label>
                                    <p class="form-control-plaintext">
                                        <span class="badge bg-label-primary fs-6">{{ $user->rut }}</span>
                                    </p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">Email</label>
                                    <p class="form-control-plaintext">
                                        <i class="ti ti-mail me-2 text-primary"></i>{{ $user->email }}
                                    </p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">Nombre</label>
                                    <p class="form-control-plaintext">{{ $user->nombre }}</p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">Apellido</label>
                                    <p class="form-control-plaintext">{{ $user->apellido }}</p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">Fecha de Registro</label>
                                    <p class="form-control-plaintext">
                                        <i class="ti ti-calendar me-2 text-success"></i>{{ $user->created_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">Última Actualización</label>
                                    <p class="form-control-plaintext">
                                        <i class="ti ti-clock me-2 text-info"></i>{{ $user->updated_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Estadísticas del Usuario -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Información Adicional</h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-3">
                                                    <span class="avatar-initial rounded bg-label-success">
                                                        <i class="ti ti-calendar-plus"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $user->created_at->diffForHumans() }}</h6>
                                                    <small class="text-muted">Tiempo en el sistema</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-3">
                                                    <span class="avatar-initial rounded bg-label-info">
                                                        <i class="ti ti-id"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">#{{ $user->id }}</h6>
                                                    <small class="text-muted">ID del Sistema</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-3">
                                                    <span class="avatar-initial rounded bg-label-primary">
                                                        <i class="ti ti-shield-check"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Verificado</h6>
                                                    <small class="text-muted">Estado de cuenta</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                            <i class="ti ti-arrow-left me-2"></i>Volver al Listado
                        </a>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">
                            <i class="ti ti-pencil me-2"></i>Editar Usuario
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
                    <h4 class="mb-2">¿Eliminar Usuario?</h4>
                    <p class="text-muted mb-4">
                        Estás a punto de eliminar a <strong>{{ $user->nombre }} {{ $user->apellido }}</strong>. 
                        Esta acción no se puede deshacer.
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar Usuario</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection