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
                    <h5 class="card-title mb-0">Crear Nuevo Cliente</h5>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('clients.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="rut">RUT <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('rut') is-invalid @enderror" 
                                       id="rut" name="rut" value="{{ old('rut') }}" 
                                       placeholder="12.345.678-9" required>
                                @error('rut')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="nombre">Nombre/Razón Social <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                       id="nombre" name="nombre" value="{{ old('nombre') }}" 
                                       placeholder="Empresa S.A." required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="contacto@empresa.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="telefono">Teléfono</label>
                                <input type="text" class="form-control @error('telefono') is-invalid @enderror" 
                                       id="telefono" name="telefono" value="{{ old('telefono') }}" 
                                       placeholder="+56 9 1234 5678">
                                @error('telefono')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="ciudad">Ciudad</label>
                                <input type="text" class="form-control @error('ciudad') is-invalid @enderror" 
                                       id="ciudad" name="ciudad" value="{{ old('ciudad') }}" 
                                       placeholder="Santiago">
                                @error('ciudad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="region">Región</label>
                                <select class="form-select @error('region') is-invalid @enderror" id="region" name="region">
                                    <option value="">Seleccionar región</option>
                                    <option value="Región Metropolitana" {{ old('region') == 'Región Metropolitana' ? 'selected' : '' }}>Región Metropolitana</option>
                                    <option value="Valparaíso" {{ old('region') == 'Valparaíso' ? 'selected' : '' }}>Valparaíso</option>
                                    <option value="Biobío" {{ old('region') == 'Biobío' ? 'selected' : '' }}>Biobío</option>
                                    <option value="Araucanía" {{ old('region') == 'Araucanía' ? 'selected' : '' }}>Araucanía</option>
                                    <option value="Los Lagos" {{ old('region') == 'Los Lagos' ? 'selected' : '' }}>Los Lagos</option>
                                    <option value="Antofagasta" {{ old('region') == 'Antofagasta' ? 'selected' : '' }}>Antofagasta</option>
                                    <option value="Atacama" {{ old('region') == 'Atacama' ? 'selected' : '' }}>Atacama</option>
                                    <option value="Coquimbo" {{ old('region') == 'Coquimbo' ? 'selected' : '' }}>Coquimbo</option>
                                    <option value="O'Higgins" {{ old('region') == "O'Higgins" ? 'selected' : '' }}>O'Higgins</option>
                                    <option value="Maule" {{ old('region') == 'Maule' ? 'selected' : '' }}>Maule</option>
                                    <option value="Ñuble" {{ old('region') == 'Ñuble' ? 'selected' : '' }}>Ñuble</option>
                                    <option value="Los Ríos" {{ old('region') == 'Los Ríos' ? 'selected' : '' }}>Los Ríos</option>
                                    <option value="Aysén" {{ old('region') == 'Aysén' ? 'selected' : '' }}>Aysén</option>
                                    <option value="Magallanes" {{ old('region') == 'Magallanes' ? 'selected' : '' }}>Magallanes</option>
                                    <option value="Arica y Parinacota" {{ old('region') == 'Arica y Parinacota' ? 'selected' : '' }}>Arica y Parinacota</option>
                                    <option value="Tarapacá" {{ old('region') == 'Tarapacá' ? 'selected' : '' }}>Tarapacá</option>
                                </select>
                                @error('region')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label class="form-label" for="direccion">Dirección</label>
                                <textarea class="form-control @error('direccion') is-invalid @enderror" 
                                          id="direccion" name="direccion" rows="2" 
                                          placeholder="Av. Libertador 123, Providencia">{{ old('direccion') }}</textarea>
                                @error('direccion')
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