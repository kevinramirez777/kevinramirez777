@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #000;
        color: #fff;
    }

    .catalog-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .catalog-header h1 {
        font-size: 1.8rem;
        font-weight: bold;
        color: #ff6600;
        text-shadow: 0 0 6px #ff6600;
    }

    /* BOTÓN CREAR */
    .btn-create {
        background-color: #ff6600;
        color: #fff;
        font-weight: bold;
        border-radius: 8px;
        padding: 0.4rem 1rem;
        box-shadow: 0 0 10px rgba(255,96,0,0.4);
    }

    .btn-create:hover {
        background-color: #e65c00;
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

    /* BOTONES ACCIÓN */
    .btn-view {
        background-color: #17a2b8;
        color: #fff;
        margin-right: 5px;
        border-radius: 6px;
        font-weight: bold;
        padding: 0.25rem 0.6rem;
        font-size: 0.875rem;
    }

    .btn-edit {
        background-color: #ffc107;
        color: #000;
        border-radius: 6px;
        font-weight: bold;
        padding: 0.25rem 0.6rem;
        font-size: 0.875rem;
    }

    .btn-view:hover { background-color: #138496; }
    .btn-edit:hover { background-color: #e0a800; }

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
            <div class="catalog-header">
                <h1>📦 SECCIÓN CATÁLOGO</h1>
                <a href="{{ route('admin.categoria.create') }}" class="btn btn-create">➕ CREAR CATEGORÍA</a>
            </div>

            @if ($categorias->count())
                <table class="table table-bordered table-striped table-custom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>ACCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categorias as $c)
                            <tr>
                                <td>{{ $c->id }}</td>
                                <td>{{ $c->nombre }}</td>
                                <td>
                                    <a href="{{ route('admin.categoria.show', $c->id) }}" class="btn btn-view btn-sm">👁 Ver Productos</a>
                                    <a href="{{ route('admin.categoria.edit', $c->id) }}" class="btn btn-edit btn-sm">✏️ Editar</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3">No hay categorías registradas.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning mt-3">⚠️ No hay categorías disponibles.</div>
            @endif
        </div>
    </div>
</div>
@endsection
