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
        box-shadow: 0 0 15px rgba(255,96,0,0.4);
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

    .btn-success {
        background-color: #ff6600;
        color: #fff;
        font-weight: bold;
        padding: 0.4rem 1rem;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(255,96,0,0.4);
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

        <div class="col-sm-8">
            <div class="form-card">
                <h2>✏️ Editar Precio</h2>

                <form action="{{ route('admin.precio.update', $precio) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $precio->nombre }}" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="text" name="precio" id="precio" class="form-control" value="{{ $precio->precio }}" required>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="javascript: history.go(-1)" class="btn btn-outline-primary">← Regresar</a>
                        <button type="submit" class="btn btn-success">💾 Guardar Precio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
