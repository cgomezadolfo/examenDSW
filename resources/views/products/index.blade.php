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
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm me-3">
                                                    <span class="avatar-initial rounded-circle bg-label-success">
                                                        <i class="ti ti-package"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $product->nombre }}</h6>
                                                    @if($product->codigo_barras)
                                                        <small class="text-muted">{{ $product->codigo_barras }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-label-primary">{{ $product->categoria }}</span>
                                        </td>
                                        <td>
                                            <strong>${{ number_format($product->precio, 0, ',', '.') }}</strong>
                                        </td>
                                        <td>
                                            @if($product->stock > 10)
                                                <span class="badge bg-success">{{ $product->stock }}</span>
                                            @elseif($product->stock > 0)
                                                <span class="badge bg-warning">{{ $product->stock }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $product->stock }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->stock > 0)
                                                <span class="badge bg-label-success">Disponible</span>
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
                                        <td colspan="6" class="text-center py-4">
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