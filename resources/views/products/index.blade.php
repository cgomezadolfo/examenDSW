@extends('layouts.app')

@section('title', 'Gestión de Productos - VentasFix')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Gestión de Productos</h5>
                    <a href="{{ route('products.create') }}" class="btn btn-success">
                        <i class="ti ti-plus me-2"></i>Nuevo Producto
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
                                    <th>SKU</th>
                                    <th>Nombre</th>
                                    <th>Precio Neto</th>
                                    <th>Precio Venta</th>
                                    <th>Stock</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>
                                            <span class="badge bg-label-info">{{ $product->sku }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm me-3">
                                                    @if($product->imagen_url)
                                                        <img src="{{ $product->imagen_url }}" alt="{{ $product->nombre }}" class="rounded-circle">
                                                    @else
                                                        <span class="avatar-initial rounded-circle bg-label-success">
                                                            <i class="ti ti-package"></i>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $product->nombre }}</h6>
                                                    <small class="text-muted">{{ Str::limit($product->descripcion_corta, 30) }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <strong>${{ number_format($product->precio_neto, 0, ',', '.') }}</strong>
                                        </td>
                                        <td>
                                            <strong>${{ number_format($product->precio_venta, 0, ',', '.') }}</strong>
                                            <small class="text-muted d-block">IVA incl.</small>
                                        </td>
                                        <td>
                                            @if($product->stock_actual > $product->stock_alto)
                                                <span class="badge bg-success">{{ $product->stock_actual }}</span>
                                            @elseif($product->stock_actual > $product->stock_bajo)
                                                <span class="badge bg-warning">{{ $product->stock_actual }}</span>
                                            @elseif($product->stock_actual > 0)
                                                <span class="badge bg-danger">{{ $product->stock_actual }}</span>
                                            @else
                                                <span class="badge bg-dark">0</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->stock_actual > $product->stock_bajo)
                                                <span class="badge bg-label-success">Disponible</span>
                                            @elseif($product->stock_actual > 0)
                                                <span class="badge bg-label-warning">Stock Bajo</span>
                                            @else
                                                <span class="badge bg-label-danger">Sin Stock</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('products.show', $product) }}">
                                                        <i class="ti ti-eye me-2"></i>Ver Detalles
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('products.edit', $product) }}">
                                                        <i class="ti ti-pencil me-2"></i>Editar
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger" 
                                                                onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                                            <i class="ti ti-trash me-2"></i>Eliminar
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="empty-state">
                                                <i class="ti ti-package ti-5x text-muted mb-3"></i>
                                                <h5 class="text-muted">No hay productos registrados</h5>
                                                <p class="text-muted">Comienza agregando el primer producto al catálogo</p>
                                                <a href="{{ route('products.create') }}" class="btn btn-success">
                                                    <i class="ti ti-plus me-2"></i>Crear Producto
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($products->hasPages())
                        <div class="row mt-4">
                            <div class="col">
                                <div class="d-flex justify-content-center">
                                    {{ $products->links() }}
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