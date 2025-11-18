@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #000;
        color: #fff;
    }

    .precio-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    .precio-header h2 {
        font-size: 1.5rem;
        font-weight: bold;
        color: #ff6600;
        text-shadow: 0 0 6px #ff6600;
    }

    /* BOTÓN CREAR */
    .btn-success {
        background-color: #ff6600;
        border: none;
        font-weight: bold;
        border-radius: 8px;
        padding: 0.4rem 1rem;
        box-shadow: 0 0 10px rgba(255,96,0,0.4);
    }

    .btn-success:hover {
        background-color: #e65c00;
    }

    /* BOTONES REGRESAR */
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

    .btn-outline-secondary {
        border: 1px solid #888;
        color: #888;
        font-weight: bold;
        border-radius: 8px;
        padding: 0.4rem 1rem;
    }

    .btn-outline-secondary:hover {
        background-color: #888;
        color: #fff;
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
        text-align: center;
        vertical-align: middle;
        color: #fff;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #2a2a2a;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #1c1c1c;
    }

    /* BOTONES ACCIÓN */
    .btn-edit {
        background-color: #ffc107;
        color: #000;
        margin-right: 5px;
        border-radius: 6px;
        font-weight: bold;
        padding: 0.25rem 0.6rem;
        font-size: 0.875rem;
    }

    .btn-delete {
        background-color: #dc3545;
        color: #fff;
        border-radius: 6px;
        font-weight: bold;
        padding: 0.25rem 0.6rem;
        font-size: 0.875rem;
    }

    .btn-edit:hover { background-color: #e0a800; }
    .btn-delete:hover { background-color: #c82333; }

    .text-success {
        color: #28a745 !important;
        font-weight: bold;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        @include("admin.menu")

        <div class="col-sm-10">
            <div class="precio-header">
                <h2>💲 Precios de {{ $producto->nombre }}</h2>
                <a href="{{ route('admin.precio.create') }}" class="btn btn-success">➕ Crear Precio</a>
            </div>

            <div class="mb-2">
                <a href="{{ route('admin.categoria.index') }}" class="btn btn-outline-primary">← Regresar al Catálogo</a>
                <a href="{{ route('admin.producto.index') }}" class="btn btn-outline-secondary">← Regresar a Productos</a>
            </div>

            @if ($precios->count())
                <table class="table table-bordered table-striped table-custom mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($precios as $c)
                            <tr>
                                <td>{{ $c->id }}</td>
                                <td>{{ $c->nombre }}</td>
                                <td><span class="text-success">${{ $c->precio }}</span></td>
                                <td>
                                    <a href="{{ route('admin.precio.edit', $c->id) }}" class="btn btn-edit btn-sm">✏️ Editar</a>
                                    <form action="{{ route('admin.precio.destroy', $c->id) }}" method="post" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete btn-sm">🗑 Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4">No hay precios registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning mt-3 text-center fw-bold">⚠️ No hay precios disponibles para este producto.</div>
            @endif

            <div class="mt-3">
                <a href="javascript: history.go(-1)" class="btn btn-outline-primary">← Regresar</a>
            </div>
        </div>
    </div>
</div>
@endsection
