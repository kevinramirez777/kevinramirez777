@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #000;
        color: #fff;
    }

    /* HEADER */
    .client-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .client-header h1 {
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
        padding: 0.5rem 1rem;
        transition: 0.3s ease;
    }

    .btn-create:hover {
        background-color: #e65c00;
        transform: scale(1.05);
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
    .btn-edit {
        background-color: #17a2b8;
        color: #fff;
        margin-right: 5px;
        border-radius: 6px;
        font-weight: bold;
    }

    .btn-edit:hover {
        background-color: #138496;
    }

    .btn-delete {
        background-color: #dc3545;
        color: #fff;
        border-radius: 6px;
        font-weight: bold;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }

    .btn-update-role {
        background-color: #ff6600;
        color: #fff;
        margin-left: 5px;
        border-radius: 6px;
        font-weight: bold;
    }

    .btn-update-role:hover {
        background-color: #e65c00;
    }

    /* SELECT ROLES */
    .form-select {
        background-color: #1c1c1c;
        color: #fff;
        border: 1px solid #444;
    }

    .form-select:focus {
        border-color: #ff6600;
        box-shadow: none;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        @include("admin.menu")

        <div class="col-sm-10">
            <div class="client-header">
                <h1>👥 SECCIÓN CLIENTE</h1>
                <a href="{{ route('admin.user.create') }}" class="btn btn-create">➕ CREAR USUARIO</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success text-center fw-bold">{{ session('success') }}</div>
            @endif

            @if ($users->count())
                <table class="table table-bordered table-striped table-custom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>CELULAR</th>
                            <th>DIRECCIÓN</th>
                            <th>ROL ACTUAL</th>
                            <th>CAMBIAR ROL</th>
                            <th>ACCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $c)
                            <tr>
                                <td>{{ $c->id }}</td>
                                <td>{{ $c->name }}</td>
                                <td>{{ $c->celular }}</td>
                                <td>{{ $c->direccion }}</td>
                                <td>{{ $c->getRoleNames()->implode(', ') }}</td>
                                <td>
                                    <form action="{{ route('admin.usuarios.updateRole', $c->id) }}" method="POST" class="d-flex justify-content-center">
                                        @csrf
                                        <select name="role" class="form-select form-select-sm">
                                            <option value="cliente" {{ $c->hasRole('cliente') ? 'selected' : '' }}>Cliente</option>
                                            <option value="admin" {{ $c->hasRole('admin') ? 'selected' : '' }}>Administrador</option>
                                        </select>
                                        <button type="submit" class="btn btn-update-role btn-sm">🔄 Actualizar</button>
                                    </form>
                                </td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('admin.user.edit', $c->id) }}" class="btn btn-edit btn-sm">✏️ Editar</a>
                                    <form action="{{ route('admin.user.destroy', $c->id) }}" method="post" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete btn-sm">🗑 Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7">No hay clientes registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning mt-3 text-center fw-bold">⚠️ No hay clientes disponibles.</div>
            @endif
        </div>
    </div>
</div>
@endsection
