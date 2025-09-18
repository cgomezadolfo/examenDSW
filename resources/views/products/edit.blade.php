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
                                <label class="form-label" for="sku">SKU <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('sku') is-invalid @enderror" 
                                       id="sku" name="sku" value="{{ old('sku', $product->sku) }}" 
                                       placeholder="Código SKU único" required>
                                @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="nombre">Nombre del Producto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                       id="nombre" name="nombre" value="{{ old('nombre', $product->nombre) }}" 
                                       placeholder="Nombre del producto" required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label" for="descripcion_corta">Descripción Corta <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('descripcion_corta') is-invalid @enderror" 
                                       id="descripcion_corta" name="descripcion_corta" value="{{ old('descripcion_corta', $product->descripcion_corta) }}" 
                                       placeholder="Descripción breve del producto" required>
                                @error('descripcion_corta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label class="form-label" for="descripcion_larga">Descripción Detallada</label>
                                <textarea class="form-control @error('descripcion_larga') is-invalid @enderror" 
                                          id="descripcion_larga" name="descripcion_larga" rows="3" 
                                          placeholder="Descripción detallada del producto">{{ old('descripcion_larga', $product->descripcion_larga) }}</textarea>
                                @error('descripcion_larga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="imagen_url">URL de Imagen</label>
                                <input type="url" class="form-control @error('imagen_url') is-invalid @enderror" 
                                       id="imagen_url" name="imagen_url" value="{{ old('imagen_url', $product->imagen_url) }}" 
                                       placeholder="https://ejemplo.com/imagen.jpg">
                                @error('imagen_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="precio_neto">Precio Neto <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control @error('precio_neto') is-invalid @enderror" 
                                           id="precio_neto" name="precio_neto" value="{{ old('precio_neto', $product->precio_neto) }}" 
                                           min="0" step="0.01" placeholder="0.00" required>
                                </div>
                                @error('precio_neto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Precio actual con IVA: ${{ number_format($product->precio_venta, 2) }}</div>
                            </div>

                            <div class="col-md-3 mb-4">
                                <label class="form-label" for="stock_actual">Stock Actual <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('stock_actual') is-invalid @enderror" 
                                       id="stock_actual" name="stock_actual" value="{{ old('stock_actual', $product->stock_actual) }}" 
                                       min="0" placeholder="0" required>
                                @error('stock_actual')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($product->isStockLow())
                                    <small class="form-text text-warning">
                                        <i class="ti ti-alert-triangle"></i> Stock bajo - considera reabastecer
                                    </small>
                                @endif
                            </div>

                            <div class="col-md-3 mb-4">
                                <label class="form-label" for="stock_minimo">Stock Mínimo <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('stock_minimo') is-invalid @enderror" 
                                       id="stock_minimo" name="stock_minimo" value="{{ old('stock_minimo', $product->stock_minimo) }}" 
                                       min="0" placeholder="0" required>
                                @error('stock_minimo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-4">
                                <label class="form-label" for="stock_bajo">Stock Bajo <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('stock_bajo') is-invalid @enderror" 
                                       id="stock_bajo" name="stock_bajo" value="{{ old('stock_bajo', $product->stock_bajo) }}" 
                                       min="0" placeholder="0" required>
                                @error('stock_bajo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-4">
                                <label class="form-label" for="stock_alto">Stock Alto <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('stock_alto') is-invalid @enderror" 
                                       id="stock_alto" name="stock_alto" value="{{ old('stock_alto', $product->stock_alto) }}" 
                                       min="0" placeholder="0" required>
                                @error('stock_alto')
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