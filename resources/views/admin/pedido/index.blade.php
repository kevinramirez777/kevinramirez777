@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #000;
        color: #fff;
    }

    .pedido-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .pedido-header h1 {
        font-size: 1.8rem;
        font-weight: bold;
        color: #ff6600;
        text-shadow: 0 0 6px #ff6600;
    }

    /* TABLA */
    .table-custom {
        background-color: #1c1c1c;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 15px rgba(255,96,0,0.4);
    }

    .table-custom th {
        background-color: #ff6600;
        color: #fff;
        text-align: center;
        font-weight: bold;
    }

    .table-custom td {
        vertical-align: middle;
        text-align: center;
        color: #fff;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #2a2a2a;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #1c1c1c;
    }

    /* BOTÓN DETALLE */
    .btn-detail {
        background-color: #17a2b8;
        color: #fff;
        font-weight: bold;
        border-radius: 6px;
        padding: 0.4rem 0.8rem;
        box-shadow: 0 0 8px rgba(23,162,184,0.4);
    }

    .btn-detail:hover {
        background-color: #138496;
    }

    /* BADGES ESTADO */
    .badge {
        font-size: 0.9rem;
        padding: 0.4rem 0.6rem;
        border-radius: 6px;
        font-weight: bold;
    }

    .badge.bg-warning {
        background-color: #ffc107 !important;
        color: #000 !important;
    }

    .badge.bg-success {
        background-color: #28a745 !important;
    }

    .badge.bg-secondary {
        background-color: #6c757d !important;
    }

    .alert-warning {
        background-color: #2a2a2a;
        color: #ff6600;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        text-align: center;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        @include("admin.menu")

        <div class="col-sm-10">
            <div class="pedido-header">
                <h1>🛒 SECCIÓN PEDIDOS</h1>
            </div>

            @if ($pedidos->count())
                <table class="table table-bordered table-striped table-custom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Fecha Pedido</th>
                            <th>Procedencia</th>
                            <th>Total USD</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pedidos as $c)
                            <tr>
                                <td>{{ $c->id }}</td>
                                <td>{{ $c->user->name }}</td>
                                <td>{{ $c->fechapedido }}</td>
                                <td>{{ $c->procedencia }}</td>
                                <td><span class="fw-bold text-success">${{ $c->total }}</span></td>
                                <td>
                                    @if($c->estado === 'Pendiente')
                                        <span class="badge bg-warning">Pendiente</span>
                                    @elseif($c->estado === 'Completado')
                                        <span class="badge bg-success">Completado</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $c->estado }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.pedido.edit', $c->id) }}" class="btn btn-detail btn-sm">👁 Ver detalle</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7">No hay pedidos registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning mt-3">⚠️ No hay pedidos disponibles.</div>
            @endif
        </div>
    </div>
</div>
@endsection
