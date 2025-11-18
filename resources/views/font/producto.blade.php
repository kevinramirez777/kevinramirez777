@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #000;
        color: #fff;
    }

    .producto-card {
        background-color: #1c1c1c;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 0 15px rgba(255,96,0,0.4);
        margin-top: 2rem;
    }

    .producto-card h2 {
        font-size: 1.8rem;
        font-weight: bold;
        color: #ff6600;
        text-shadow: 0 0 6px #ff6600;
    }

    .precio-text {
        font-size: 1.4rem;
        font-weight: bold;
        color: #28a745;
        margin-top: 1rem;
    }

    .form-control {
        background-color: #2a2a2a;
        color: #fff;
        border: 1px solid #444;
        border-radius: 8px;
        margin-top: 0.5rem;
    }

    .form-control:focus {
        border-color: #ff6600;
        box-shadow: none;
    }

    .descripcion {
        margin-top: 2rem;
        font-size: 1.1rem;
        line-height: 1.6;
        color: #ddd;
    }

    .img-fluid {
        border-radius: 12px;
        box-shadow: 0 0 12px rgba(255,96,0,0.4);
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="producto-card row">
                <div class="col-sm-6">
                    <img src="/img/{{ $producto->urlfoto }}" class="img-fluid mx-auto d-block">
                </div>
                <div class="col-sm-6 pt-3 pb-3">
                    <h2>{{ $producto->nombre }}</h2>
                    @if ($producto->precios->count())
                        <p id="txtprecio{{ $producto->id }}" class="precio-text">
                            USD {{ $producto->precios[0]->precio }}
                        </p>
                        <select name="precios" id="{{ $producto->id }}" class="form-control precios">
                            @foreach($producto->precios as $item)
                                <option value="{{ $item->precio }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    @else
                        <p class="precio-text">USD {{ $producto->precio }}</p>
                    @endif
                </div>
                <div class="col-sm-12 descripcion">
                    {{ $producto->descripcion }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll(".precios").forEach(element => {
        element.addEventListener("change", e => {
            document.getElementById("txtprecio" + e.target.id).textContent = "USD " + e.target.value;
        });
    });
</script>
@endsection
