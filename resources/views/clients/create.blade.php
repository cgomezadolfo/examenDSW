@extends('layouts.app')

@section('title', 'Nuevo Cliente - VentasFix')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Clientes</a></li>
                    <li class="breadcrumb-item active">Nuevo Cliente</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Crear Nuevo Cliente Empresarial</h5>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('clients.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Información de la Empresa -->
                            <div class="col-12 mb-3">
                                <h6 class="text-primary">Información de la Empresa</h6>
                                <hr>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="rut_empresa">RUT Empresa <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('rut_empresa') is-invalid @enderror" 
                                       id="rut_empresa" name="rut_empresa" value="{{ old('rut_empresa') }}" 
                                       placeholder="76.123.456-7" required>
                                @error('rut_empresa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="rubro">Rubro <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('rubro') is-invalid @enderror" 
                                       id="rubro" name="rubro" value="{{ old('rubro') }}" 
                                       placeholder="Tecnología, Retail, Construcción, etc." required>
                                @error('rubro')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label" for="razon_social">Razón Social <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('razon_social') is-invalid @enderror" 
                                       id="razon_social" name="razon_social" value="{{ old('razon_social') }}" 
                                       placeholder="Tech Solutions SpA" required>
                                @error('razon_social')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="telefono">Teléfono <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('telefono') is-invalid @enderror" 
                                       id="telefono" name="telefono" value="{{ old('telefono') }}" 
                                       placeholder="+56912345678" required>
                                @error('telefono')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="direccion">Dirección <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('direccion') is-invalid @enderror" 
                                          id="direccion" name="direccion" rows="2" 
                                          placeholder="Av. Providencia 123, Las Condes, Santiago" required>{{ old('direccion') }}</textarea>
                                @error('direccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Información de Contacto -->
                            <div class="col-12 mb-3 mt-4">
                                <h6 class="text-info">Persona de Contacto</h6>
                                <hr>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="nombre_contacto">Nombre Contacto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nombre_contacto') is-invalid @enderror" 
                                       id="nombre_contacto" name="nombre_contacto" value="{{ old('nombre_contacto') }}" 
                                       placeholder="Juan Pérez González" required>
                                @error('nombre_contacto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="email_contacto">Email Contacto <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email_contacto') is-invalid @enderror" 
                                       id="email_contacto" name="email_contacto" value="{{ old('email_contacto') }}" 
                                       placeholder="juan.perez@empresa.cl" required>
                                @error('email_contacto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">
                                <i class="ti ti-arrow-left me-2"></i>Volver
                            </a>
                            <button type="submit" class="btn btn-info">
                                <i class="ti ti-check me-2"></i>Crear Cliente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection