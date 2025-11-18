@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #000;
        color: #fff;
    }

    /* ENCABEZADO */
    .producto-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .producto-header h1 {
        font-size: 1.8rem;
        font-weight: bold;
        color: #ff6600;
        text-shadow: 0 0 6px #ff6600;
    }

    /* BOTONES SUPERIORES */
    .btn-create {
        background-color: #ff6600;
        color: #fff;
        font-weight: bold;
        border-radius: 8px;
        padding: 0.4rem 1rem;
        box-shadow: 0 0 10px rgba(255, 96, 0, 0.4);
    }

    .btn-create:hover {
        background-color: #e65c00;
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

    /* TABLA */
    .table-custom {
        background-color: #1c1c1c;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 15px rgba(255, 96, 0, 0.4);
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

    /* BOTONES DE ACCIÓN */
    .btn-action {
        margin: 2px;
        border-radius: 6px;
        font-weight: bold;
        padding: 0.25rem 0.6rem;
        font-size: 0.875rem;
    }

    .btn-add {
        background-color: #17a2b8;
        color: #fff;
    }

    .btn-edit {
        background-color: #ffc107;
        color: #000;
    }

    .btn-delete {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-add:hover { background-color: #138496; }
    .btn-edit:hover { background-color: #e0a800; }
    .btn-delete:hover { background-color: #c82333; }

    /* TEXTO Y IMAGEN */
    .text-success {
        color: #28a745 !important;
    }

    .text-muted {
        color: #aaa !important;
    }

    .shadow-sm {
        box-shadow: 0 0 6px rgba(255, 96, 0, 0.3);
    }

    .list-unstyled li {
        font-size: 0.9rem;
        text-align: left;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        @include("admin.menu")

        <div class="col-sm-10">
            <div class="producto-header">
                <h1>🍕 Productos de {{ $categoria->nombre }}</h1>
                <div>
                    <a href="{{ route('admin.producto.create') }}" class="btn btn-create">➕ Crear Producto</a>
                    <a href="{{ route('admin.categoria.index') }}" class="btn btn-outline-primary ms-2">← Regresar al Catálogo</a>
                </div>
            </div>

            @if ($productos->count())
                <table class="table table-bordered table-striped table-custom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Precio Base</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($productos as $c)
                            <tr>
                                <td>{{ $c->id }}</td>
                                <td>
                                    <img src="/img/{{ $c->urlfoto }}" width="100" class="border rounded shadow-sm">
                                </td>
                                <td>
                                    <strong>{{ $c->nombre }}</strong>
                                    <ul class="list-unstyled mt-2">
                                        @forelse ($c->precios as $p)
                                            <li>🍴 {{ $p->nombre }} — <span class="text-success">${{ $p->precio }}</span></li>
                                        @empty
                                            <li class="text-muted">Sin precios adicionales</li>
                                        @endforelse
                                    </ul>
                                </td>
                                <td><span class="fw-bold text-success">${{ $c->precio }}</span></td>
                                <td>
                                    <a href="{{ route('admin.precio.show', $c->id) }}" class="btn btn-add btn-action">➕ Precio</a>
                                    <a href="{{ route('admin.producto.edit', $c->id) }}" class="btn btn-edit btn-action">✏️ Editar</a>
                                    <form action="{{ route('admin.producto.destroy', $c->id) }}" method="post" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete btn-action">🗑 Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5">No hay productos registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning mt-3 text-center fw-bold">⚠️ No hay productos disponibles en esta categoría.</div>
            @endif
        </div>
    </div>
</div>
@endsection
