@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #000;
        color: #fff;
    }

    .card {
        background-color: #1c1c1c;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(255,96,0,0.4);
        margin-top: 2rem;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #2a2a2a;
        border-bottom: 1px solid #444;
        padding: 1rem;
        border-radius: 12px 12px 0 0;
    }

    .pedido-title {
        font-size: 1.4rem;
        font-weight: bold;
        color: #ff6600;
        text-shadow: 0 0 6px #ff6600;
    }

    .badge-estado {
        font-size: 1rem;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-weight: bold;
    }

    .badge.bg-danger { background-color: #dc3545 !important; }
    .badge.bg-warning { background-color: #ffc107 !important; color: #000 !important; }
    .badge.bg-success { background-color: #28a745 !important; }
    .badge.bg-secondary { background-color: #6c757d !important; }

    .form-select {
        background-color: #2a2a2a;
        color: #fff;
        border: 1px solid #444;
        border-radius: 8px;
    }

    .btn-success {
        background-color: #ff6600;
        color: #fff;
        font-weight: bold;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(255,96,0,0.4);
    }

    .btn-success:hover {
        background-color: #e65c00;
    }

    .list-group-item {
        background-color: #2a2a2a;
        color: #fff;
        border: 1px solid #444;
    }

    .table {
        background-color: #1c1c1c;
        color: #fff;
    }

    .table thead {
        background-color: #ff6600;
        color: #fff;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #2a2a2a;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #1c1c1c;
    }

    .btn-outline-primary {
        border: 1px solid #ff6600;
        color: #ff6600;
        font-weight: bold;
        border-radius: 8px;
        padding: 0.4rem 1rem;
    }

    .btn-outline-primary:hover {
        background-color: #ff6600;
        color: #fff;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        @include("admin.menu")

        <div class="col-sm-10">
            <div class="card shadow-sm">
                <div class="card-header">
                    <div class="col-sm-6">
                        <h1 class="pedido-title">
                            🛒 Pedido N°: {{ $pedido->id }}
                            @if($pedido->estado === 'nuevo')
                                <span class="badge bg-danger badge-estado">Nuevo</span>
                            @elseif($pedido->estado === 'proceso')
                                <span class="badge bg-warning badge-estado">En Proceso</span>
                            @elseif($pedido->estado === 'entregado')
                                <span class="badge bg-success badge-estado">Entregado</span>
                            @else
                                <span class="badge bg-secondary badge-estado">{{ strtoupper($pedido->estado) }}</span>
                            @endif
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <form action="{{ route('admin.pedido.update', $pedido) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-6">
                                    <select name="estado" class="form-select">
                                        <option value="nuevo" {{ $pedido->estado == 'nuevo' ? 'selected' : '' }}>Nuevo</option>
                                        <option value="proceso" {{ $pedido->estado == 'proceso' ? 'selected' : '' }}>En Proceso</option>
                                        <option value="entregado" {{ $pedido->estado == 'entregado' ? 'selected' : '' }}>Entregado</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-success w-100">Actualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="list-group mb-3">
                        <li class="list-group-item"><strong>Cliente:</strong> {{ $pedido->user->name }}</li>
                        <li class="list-group-item"><strong>Celular:</strong> {{ $pedido->user->celular }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ $pedido->user->email }}</li>
                        <li class="list-group-item"><strong>Dirección:</strong> {{ $pedido->user->direccion }}</li>
                        <li class="list-group-item"><strong>Fecha Pedido:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</li>
                    </ul>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pedido->detalles as $item)
                                <tr>
                                    <td>{{ $item->producto->nombre }}</td>
                                    <td>{{ $item->cantidad }}</td>
                                    <td>${{ $item->precio }}</td>
                                    <td>${{ $item->importe }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4">No hay productos en este pedido.</td></tr>
                            @endforelse
                            <tr><td colspan="4" class="text-end"><strong>SubTotal:</strong> ${{ $pedido->subtotal }}</td></tr>
                            <tr><td colspan="4" class="text-end"><strong>Impuesto 18%:</strong> ${{ $pedido->impuesto }}</td></tr>
                            <tr><td colspan="4" class="text-end"><strong>Total:</strong> ${{ $pedido->total }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                <a href="javascript: history.go(-1)" class="btn btn-outline-primary">← Regresar</a>
            </div>
        </div>
    </div>
</div>
@endsection
