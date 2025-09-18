@extends('layouts.app')

@section('title', 'Detalles Producto - VentasFix')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
                    <li class="breadcrumb-item active">Detalles</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Detalles del Producto</h5>
                    <div class="btn-group">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-success btn-sm">
                            <i class="ti ti-pencil me-2"></i>Editar
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="ti ti-trash me-2"></i>Eliminar
                        </button>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <!-- Imagen y Estado del Producto -->
                        <div class="col-md-4">
                            <div class="text-center mb-4">
                                <div class="avatar avatar-xl mx-auto mb-3">
                                    <span class="avatar-initial rounded-circle bg-label-success fs-2">
                                        <i class="ti ti-package"></i>
                                    </span>
                                </div>
                                <h4 class="mb-1">{{ $product->nombre }}</h4>
                                @if($product->stock > 10)
                                    <span class="badge bg-success">En Stock</span>
                                @elseif($product->stock > 0)
                                    <span class="badge bg-warning">Stock Bajo</span>
                                @else
                                    <span class="badge bg-danger">Sin Stock</span>
                                @endif
                            </div>
                        </div>

                        <!-- Información Detallada -->
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">Categoría</label>
                                    <p class="form-control-plaintext">
                                        <span class="badge bg-label-primary fs-6">{{ $product->categoria }}</span>
                                    </p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">Precio</label>
                                    <p class="form-control-plaintext">
                                        <i class="ti ti-currency-dollar me-2 text-success"></i>
                                        <strong>${{ number_format($product->precio, 0, ',', '.') }}</strong>
                                    </p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">Stock Actual</label>
                                    <p class="form-control-plaintext">
                                        @if($product->stock > 10)
                                            <span class="badge bg-success fs-6">{{ $product->stock }} unidades</span>
                                        @elseif($product->stock > 0)
                                            <span class="badge bg-warning fs-6">{{ $product->stock }} unidades</span>
                                        @else
                                            <span class="badge bg-danger fs-6">{{ $product->stock }} unidades</span>
                                        @endif
                                    </p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">Código de Barras</label>
                                    <p class="form-control-plaintext">
                                        @if($product->codigo_barras)
                                            <code>{{ $product->codigo_barras }}</code>
                                        @else
                                            <span class="text-muted">No asignado</span>
                                        @endif
                                    </p>
                                </div>

                                @if($product->descripcion)
                                <div class="col-12 mb-4">
                                    <label class="form-label text-muted">Descripción</label>
                                    <p class="form-control-plaintext">{{ $product->descripcion }}</p>
                                </div>
                                @endif

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">Fecha de Registro</label>
                                    <p class="form-control-plaintext">
                                        <i class="ti ti-calendar me-2 text-info"></i>{{ $product->created_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted">Última Actualización</label>
                                    <p class="form-control-plaintext">
                                        <i class="ti ti-clock me-2 text-secondary"></i>{{ $product->updated_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Estadísticas del Producto -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">Información Adicional</h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-3">
                                                    <span class="avatar-initial rounded bg-label-info">
                                                        <i class="ti ti-id"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">#{{ $product->id }}</h6>
                                                    <small class="text-muted">ID del Producto</small>
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
                                                    <h6 class="mb-0">{{ $product->created_at->diffForHumans() }}</h6>
                                                    <small class="text-muted">En el catálogo</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-3">
                                                    <span class="avatar-initial rounded {{ $product->stock > 0 ? 'bg-label-success' : 'bg-label-danger' }}">
                                                        <i class="ti ti-{{ $product->stock > 0 ? 'check' : 'x' }}"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $product->stock > 0 ? 'Disponible' : 'Agotado' }}</h6>
                                                    <small class="text-muted">Estado actual</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                            <i class="ti ti-arrow-left me-2"></i>Volver al Catálogo
                        </a>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-success">
                            <i class="ti ti-pencil me-2"></i>Editar Producto
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
                    <h4 class="mb-2">¿Eliminar Producto?</h4>
                    <p class="text-muted mb-4">
                        Estás a punto de eliminar <strong>{{ $product->nombre }}</strong>. 
                        Esta acción no se puede deshacer.
                    </p>
                    @if($product->stock > 0)
                        <div class="alert alert-warning">
                            <i class="ti ti-alert-triangle me-2"></i>
                            <strong>Atención:</strong> Este producto tiene {{ $product->stock }} unidades en stock.
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar Producto</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection