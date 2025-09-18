@extends('layouts.app')

@section('title', 'Editar Producto - VentasFix')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
                    <li class="breadcrumb-item active">Editar Producto</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Editar Producto: {{ $product->nombre }}</h5>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('products.update', $product) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="nombre">Nombre del Producto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                       id="nombre" name="nombre" value="{{ old('nombre', $product->nombre) }}" 
                                       placeholder="Nombre del producto" required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="categoria">Categoría <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('categoria') is-invalid @enderror" 
                                       id="categoria" name="categoria" value="{{ old('categoria', $product->categoria) }}" 
                                       placeholder="Electrónicos, Ropa, etc." required>
                                @error('categoria')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="precio">Precio <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control @error('precio') is-invalid @enderror" 
                                           id="precio" name="precio" value="{{ old('precio', $product->precio) }}" 
                                           min="0" step="0.01" placeholder="0.00" required>
                                </div>
                                @error('precio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="stock">Stock <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                                       id="stock" name="stock" value="{{ old('stock', $product->stock) }}" 
                                       min="0" placeholder="0" required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($product->stock <= 5)
                                    <small class="form-text text-warning">
                                        <i class="ti ti-alert-triangle"></i> Stock bajo - considera reabastecer
                                    </small>
                                @endif
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="codigo_barras">Código de Barras</label>
                                <input type="text" class="form-control @error('codigo_barras') is-invalid @enderror" 
                                       id="codigo_barras" name="codigo_barras" value="{{ old('codigo_barras', $product->codigo_barras) }}" 
                                       placeholder="Código opcional">
                                @error('codigo_barras')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label class="form-label" for="descripcion">Descripción</label>
                                <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                          id="descripcion" name="descripcion" rows="3" 
                                          placeholder="Descripción del producto">{{ old('descripcion', $product->descripcion) }}</textarea>
                                @error('descripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                <i class="ti ti-arrow-left me-2"></i>Volver
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="ti ti-check me-2"></i>Actualizar Producto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection