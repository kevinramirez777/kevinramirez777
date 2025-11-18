@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #000;
        color: #fff;
    }

    .carrito-card {
        background-color: #1c1c1c;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 0 20px rgba(255,96,0,0.6);
        margin-top: 2rem;
    }

    .carrito-card h1 {
        font-size: 1.8rem;
        font-weight: bold;
        color: #ff6600;
        margin-bottom: 1.5rem;
        text-shadow: 0 0 5px #ff6600;
    }

    .table-custom th {
        background-color: #ff6600;
        color: #fff;
        text-align: center;
    }

    .table-custom td {
        text-align: center;
        vertical-align: middle;
        color: #fff;
    }

    .btn-success {
        background-color: #ff6600;
        border: none;
        font-weight: bold;
    }

    .btn-success:hover {
        background-color: #e65c00;
    }

    .btn-outline-danger {
        border-color: #ff6600;
        color: #ff6600;
        border-radius: 8px;
        font-weight: bold;
    }

    .btn-outline-danger:hover {
        background-color: #ff6600;
        color: #fff;
    }

    .btn-danger {
        background-color: #ff4500;
        border: none;
        border-radius: 8px;
        font-weight: bold;
    }

    .btn-danger:hover {
        background-color: #e63e00;
    }

    .empty-cart {
        font-size: 1.2rem;
        font-weight: bold;
        color: #888;
        margin-top: 2rem;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-10 carrito-card">
            @include("font.partials.mensaje")

            <h1 class="text-center">🛒 Carrito</h1>

            @if(Cart::content()->count())
                <table class="table table-striped table-bordered table-custom">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Importe</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Cart::content() as $item)
                            <tr>
                                <td><img src="/img/{{ $item->options->urlfoto }}" width="100" class="rounded shadow-sm"></td>
                                <td>{{ $item->name }}</td>
                                <td><span class="fw-bold text-warning"><i class="fas fa-money-bill-wave"></i> ${{ $item->price }}</span></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Cantidad">
                                        <a href="/decrementar/{{ $item->rowId }}" class="btn btn-success">-</a>
                                        <button type="button" class="btn btn-dark">{{ $item->qty }}</button>
                                        <a href="/incrementar/{{ $item->rowId }}" class="btn btn-success">+</a>
                                    </div>
                                </td>
                                <td><span class="fw-bold text-light">${{ number_format($item->qty * $item->price, 2) }}</span></td>
                                <td><a href="/eliminaritem/{{ $item->rowId }}" class="btn btn-sm btn-outline-danger">🗑</a></td>
                            </tr>
                        @endforeach
                        <tr><td colspan="6" class="text-end"><strong>Subtotal USD:</strong> {{ Cart::subtotal() }}</td></tr>
                        <tr><td colspan="6" class="text-end"><strong>Impuesto 15% USD:</strong> {{ Cart::tax() }}</td></tr>
                        <tr><td colspan="6" class="text-end fw-bold"><strong>Total USD:</strong> {{ Cart::total() }}</td></tr>
                    </tbody>
                </table>

                <div class="row justify-content-center mt-4 mb-4 text-center">
                    <div class="col-sm-4">
                        <a href="{{ route('eliminarcarrito') }}" class="btn btn-outline-danger w-100">🗑 Eliminar Carrito</a>
                    </div>
                    <div class="col-sm-4">
                        @auth
                            <a href="{{ route('confirmarcarrito') }}" class="btn btn-danger w-100">✅ Ordenar ahora</a>
                        @else
                            <a href="/login" class="btn btn-danger w-100">🔑 Entrar para Ordenar</a>
                        @endauth
                    </div>
                </div>
            @else
                <p class="text-center empty-cart">🛒 Carrito vacío</p>
            @endif
        </div>
    </div>
</div>
@endsection
