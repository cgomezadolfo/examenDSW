@extends('layouts.app')

@section('title', 'Gestión de Usuarios - VentasFix')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Gestión de Usuarios</h5>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus me-2"></i>Nuevo Usuario
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
                                    <th>RUT</th>
                                    <th>Nombre Completo</th>
                                    <th>Email</th>
                                    <th>Fecha Registro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>
                                            <span class="badge bg-label-primary">{{ $user->rut }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm me-3">
                                                    <span class="avatar-initial rounded-circle bg-label-info">
                                                        {{ strtoupper(substr($user->nombre, 0, 1)) }}{{ strtoupper(substr($user->apellido, 0, 1)) }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $user->nombre }} {{ $user->apellido }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="text-muted">{{ $user->created_at->format('d/m/Y') }}</span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('users.show', $user) }}">
                                                        <i class="ti ti-eye me-2"></i>Ver Detalles
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('users.edit', $user) }}">
                                                        <i class="ti ti-pencil me-2"></i>Editar
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger" 
                                                                onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                                            <i class="ti ti-trash me-2"></i>Eliminar
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="empty-state">
                                                <i class="ti ti-users ti-5x text-muted mb-3"></i>
                                                <h5 class="text-muted">No hay usuarios registrados</h5>
                                                <p class="text-muted">Comienza agregando el primer usuario al sistema</p>
                                                <a href="{{ route('users.create') }}" class="btn btn-primary">
                                                    <i class="ti ti-plus me-2"></i>Crear Usuario
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($users->hasPages())
                        <div class="row mt-4">
                            <div class="col">
                                <div class="d-flex justify-content-center">
                                    {{ $users->links() }}
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