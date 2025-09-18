@extends('layouts.app')

@section('title', 'Editar Usuario - VentasFix')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
                    <li class="breadcrumb-item active">Editar Usuario</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Editar Usuario: {{ $user->nombre }} {{ $user->apellido }}</h5>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="rut">RUT <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('rut') is-invalid @enderror" 
                                       id="rut" name="rut" value="{{ old('rut', $user->rut) }}" 
                                       placeholder="12.345.678-9" required>
                                @error('rut')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $user->email) }}" 
                                       placeholder="usuario@ejemplo.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="nombre">Nombre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                       id="nombre" name="nombre" value="{{ old('nombre', $user->nombre) }}" 
                                       placeholder="Juan" required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="apellido">Apellido <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('apellido') is-invalid @enderror" 
                                       id="apellido" name="apellido" value="{{ old('apellido', $user->apellido) }}" 
                                       placeholder="Pérez" required>
                                @error('apellido')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <div class="alert alert-info">
                                    <i class="ti ti-info-circle me-2"></i>
                                    <strong>Cambiar contraseña:</strong> Deja los campos en blanco si no deseas cambiar la contraseña actual.
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="password">Nueva Contraseña</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           id="password" name="password" 
                                           placeholder="········">
                                    <span class="input-group-text cursor-pointer" id="password-toggle">
                                        <i class="ti ti-eye-off"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">La contraseña debe tener al menos 8 caracteres</small>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="password_confirmation">Confirmar Nueva Contraseña</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" 
                                           id="password_confirmation" name="password_confirmation" 
                                           placeholder="········">
                                    <span class="input-group-text cursor-pointer" id="password-confirmation-toggle">
                                        <i class="ti ti-eye-off"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                <i class="ti ti-arrow-left me-2"></i>Volver
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-check me-2"></i>Actualizar Usuario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Toggle password visibility
document.getElementById('password-toggle').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const icon = this.querySelector('i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.className = 'ti ti-eye';
    } else {
        passwordInput.type = 'password';
        icon.className = 'ti ti-eye-off';
    }
});

document.getElementById('password-confirmation-toggle').addEventListener('click', function() {
    const passwordInput = document.getElementById('password_confirmation');
    const icon = this.querySelector('i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.className = 'ti ti-eye';
    } else {
        passwordInput.type = 'password';
        icon.className = 'ti ti-eye-off';
    }
});
</script>
@endpush
@endsection