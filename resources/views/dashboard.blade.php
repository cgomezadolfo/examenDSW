@extends('layouts.app')

@sect                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="avatar flex-shrink-0">
                                <img src="/assets/img/icons/unicons/cc-success.png" alt="cc success" class="rounded">
                            </div>
                        </div>title', 'Dashboard - VentasFix')

@section('content')
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-xxl-8 mb-6 order-0">
        <div class="card">
            <div class="d-flex align-items-start row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary mb-3">¡Bienvenido {{ auth()->user()->nombre }}! 🎉</h5>
                        <p class="mb-6">Panel de control del sistema VentasFix.<br>Aquí puedes gestionar usuarios, productos y clientes.</p>
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary">Ver Reportes</a>
                    </div>
                </div>
                    <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-6">
                        <img src="/assets/img/illustrations/boy-with-laptop-light.png" height="175" alt="View Badge User">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="avatar flex-shrink-0">
                                <img src="/assets/img/icons/payments/mastercard-cc.png" alt="chart success" class="rounded">
                            </div>
                        </div>
                        <p class="mb-1">Usuarios</p>
                        <h4 class="card-title mb-3">{{ $stats['total_users'] }}</h4>
                        <small class="text-success fw-medium"><i class="ti ti-arrow-up"></i> Total del sistema</small>
                        <div class="mt-3">
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary">Ver Usuarios</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-12 col-6 mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="avatar flex-shrink-0">
                                <img src="/assets/img/icons/payments/amex-cc.png" alt="wallet info" class="rounded">
                            </div>
                        </div>
                        <p class="mb-1">Productos</p>
                        <h4 class="card-title mb-3">{{ $stats['total_products'] }}</h4>
                        <small class="text-success fw-medium"><i class="ti ti-arrow-up"></i> En catálogo</small>
                        <div class="mt-3">
                            <a href="{{ route('products.index') }}" class="btn btn-sm btn-success">Ver Productos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-8 col-lg-12 col-xxl-4 order-3 order-md-2">
        <div class="row">
            <div class="col-6 mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="avatar flex-shrink-0">
                                <img src="/assets/img/icons/payments/paypal.png" alt="paypal" class="rounded">
                            </div>
                        </div>
                        <p class="mb-1">Clientes</p>
                        <h4 class="card-title mb-3">{{ $stats['total_clients'] }}</h4>
                        <small class="text-success fw-medium"><i class="ti ti-arrow-up"></i> Empresas</small>
                        <div class="mt-3">
                            <a href="{{ route('clients.index') }}" class="btn btn-sm btn-info">Ver Clientes</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-6 mb-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="avatar flex-shrink-0">
                                <img src="/assets/img/icons/payments/visa-cc.png" alt="cc warning" class="rounded">
                            </div>
                        </div>
                        <p class="mb-1">Stock Bajo</p>
                        <h4 class="card-title mb-3">{{ $stats['low_stock_products'] }}</h4>
                        <small class="text-danger fw-medium"><i class="ti ti-arrow-down"></i> Productos</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Timeline -->
    <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-6">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Usuarios Recientes</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="timeline">
                    @forelse($stats['recent_users'] as $user)
                    <div class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-primary"></span>
                        <div class="timeline-event">
                            <div class="timeline-header mb-3">
                                <h6 class="mb-0">{{ $user->nombre }} {{ $user->apellido }}</h6>
                                <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-0">{{ $user->email }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted">No hay usuarios registrados</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->
    <div class="col-md-6 col-lg-4 order-1 mb-6">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Productos Recientes</h5>
                </div>
            </div>
            <div class="card-body">
                @forelse($stats['recent_products'] as $product)
                <ul class="list-unstyled mb-0">
                    <li class="d-flex mb-4">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-package"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">{{ $product->nombre }}</h6>
                                <small class="text-muted">SKU: {{ $product->sku }}</small>
                            </div>
                            <div class="user-progress">
                                <h6 class="mb-0">${{ number_format($product->precio_venta, 0, ',', '.') }}</h6>
                            </div>
                        </div>
                    </li>
                </ul>
                @empty
                <p class="text-muted">No hay productos registrados</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Clients -->
    <div class="col-md-6 col-lg-4 order-2 mb-6">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Clientes Recientes</h5>
                </div>
            </div>
            <div class="card-body">
                @forelse($stats['recent_clients'] as $client)
                <ul class="list-unstyled mb-0">
                    <li class="d-flex mb-4">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-info"><i class="ti ti-building"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">{{ $client->razon_social }}</h6>
                                <small class="text-muted">{{ $client->rubro }}</small>
                            </div>
                            <div class="user-progress">
                                <small class="text-muted">{{ $client->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </li>
                </ul>
                @empty
                <p class="text-muted">No hay clientes registrados</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection