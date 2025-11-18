@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #000;
        color: #fff;
    }

    .form-card {
        background-color: #1c1c1c;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 0 15px rgba(255, 96, 0, 0.4);
        margin-top: 2rem;
    }

    .form-card h2 {
        font-size: 1.6rem;
        font-weight: bold;
        color: #ff6600;
        margin-bottom: 1.5rem;
        text-shadow: 0 0 6px #ff6600;
    }

    .form-label {
        font-weight: 600;
        color: #ff6600;
    }

    .form-control {
        background-color: #2a2a2a;
        color: #fff;
        border: 1px solid #444;
        border-radius: 8px;
    }

    .form-control::placeholder {
        color: #bbb;
    }

    .form-control:focus {
        border-color: #ff6600;
        box-shadow: none;
    }

    .form-check-label {
        color: #fff;
        font-weight: bold;
    }

    .btn-success {
        background-color: #ff6600;
        color: #fff;
        font-weight: bold;
        padding: 0.4rem 1rem;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(255, 96, 0, 0.4);
    }

    .btn-success:hover {
        background-color: #e65c00;
    }

    .btn-outline-primary {
        border: 1px solid #ff6600;
        color: #ff6600;
        font-weight: bold;
        padding: 0.4rem 1rem;
        border-radius: 8px;
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
            <div class="form-card">
                <h2>➕ Crear Producto</h2>

                <form action="{{ route('admin.producto.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="row mb-3">
                        <div class="col-sm-6 mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre del producto" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="precio" class="form-label">Precio Base</label>
                            <input type="number" step="0.01" name="precio" id="precio" class="form-control" placeholder="Precio en USD" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" name="stock" id="stock" class="form-control" placeholder="Cantidad disponible" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="orden" class="form-label">Orden</label>
                            <input type="number" name="orden" id="orden" class="form-control" placeholder="Orden de aparición" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="categoria_id" class="form-label">Categoría</label>
                            <select name="categoria_id" id="categoria_id" class="form-control" required>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria }}">{{ $categoria }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Descripción del producto" required></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="publicado" class="form-check-input" id="publicado">
                                <label for="publicado" class="form-check-label">Publicado</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="portada" class="form-check-input" id="portada">
                                <label for="portada" class="form-check-label">Portada</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="urlfoto" class="form-label">Imagen</label>
                        <input type="file" name="urlfoto" id="urlfoto" class="form-control">
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="javascript: history.go(-1)" class="btn btn-outline-primary">← Regresar</a>
                        <button type="submit" class="btn btn-success">💾 Crear Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
