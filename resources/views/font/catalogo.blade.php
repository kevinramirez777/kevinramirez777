@extends('layouts.app')
@section('content')
<style>
    body {
        background-color: #000;
        color: #fff;
    }

    /* TITULOS */
    h1, h2, h3 {
        font-weight: bold;
        color: #ff6600;
        text-shadow: 0 0 6px #ff6600;
    }

    /* TARJETAS */
    .card {
        background-color: #2a2a2a;
        border: none;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(255, 96, 0, 0.4);
        transition: .3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0 15px rgba(255, 96, 0, 0.7);
    }

    .card-img-top {
        height: 160px;
        object-fit: cover;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .card-body p {
        color: #fff;
        font-size: 1rem;
        font-weight: bold;
    }

    .card-footer {
        background-color: #1c1c1c;
        border-top: none;
        padding: 0.8rem;
    }

    /* BOTONES */
    .btn-success {
        background-color: #ff6600;
        border: none;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .btn-success:hover {
        background-color: #e65c00;
    }

    .btn-outline-success {
        border-color: #ff6600;
        color: #ff6600;
        font-weight: bold;
    }

    .btn-outline-success:hover {
        background-color: #ff6600;
        color: #fff;
    }

    /* INPUTS */
    .form-control {
        background-color: #1c1c1c;
        color: #fff;
        border: 1px solid #444;
    }

    .form-control:focus {
        border-color: #ff6600;
        box-shadow: none;
    }

    /* TABLAS */
    table {
        color: #fff;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #2a2a2a;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #1c1c1c;
    }

    /************************************
        🛒 RESUMEN DEL CARRITO (NUEVO)
    *************************************/
   /* .carrito-box {
        background: #1a1a1a;
        border-radius: 12px;
        padding: 15px;
        box-shadow: 0 0 15px rgba(255, 96, 0, 0.4);
    }
*/
    .carrito-box table {
        color: #fff !important;
    }

    .carrito-box .table-striped tbody tr:nth-of-type(odd) {
        background-color: #262626 !important;
    }

    .carrito-box .table-striped tbody tr:nth-of-type(even) {
        background-color: #1c1c1c !important;
    }

    .carrito-box td, 
    .carrito-box th {
        color: #fff !important;
        font-weight: bold;
    }

    .carrito-box .text-danger {
        font-size: 20px;
        font-weight: bold;
    }

    .carrito-totales p {
        color: #ff6600;
        font-weight: bold;
        font-size: 1rem;
        text-align: right;
    }

</style>

<div class="container">
    <div class="row justify-content-center">

        <!-- CATALOGO -->
        <div class="col-sm-8">
            <h1 class="text-center fs-3">CATÁLOGO</h1>

            <div class="row justify-content-center">
                @foreach ($categorias as $c)
                    <div class="col-sm-12">
                        <h2 class="text-center">{{ $c->nombre }}</h2>

                        <div class="row">

                            @forelse($c->productos as $p)
                                <div class="col-sm-4 col-6 mt-3 mb-3">
                                    <div class="card h-100">

                                        <img src="/img/{{ $p->urlfoto }}" class="card-img-top" alt="{{ $p->nombre }}">

                                        <div class="card-body text-center">

                                            @if ($p->precios->count())
                                                <p class="fw-bold fs-5" id="txtprecio{{ $p->id }}">
                                                    <i class="fas fa-money-bill-wave"></i> USD {{ $p->precios[0]->precio }}
                                                </p>

                                                <select name="precios" id="{{ $p->id }}" class="form-control precios">
                                                    @foreach($p->precios as $item)
                                                        <option value="{{ $item->precio }}" data-precioid="{{ $item->id }}">
                                                            {{ $item->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            @else
                                                <p class="fw-bold fs-5">
                                                    <i class="fas fa-money-bill-wave"></i> USD {{ $p->precio }}
                                                </p>
                                            @endif

                                            <a href="/catalogo/{{ $p->slug }}" class="text-decoration-none text-light">
                                                {{ $p->nombre }}
                                            </a>
                                        </div>

                                        <div class="card-footer">
                                            <form action="{{ route('agregaritem') }}" method="post">
                                                @csrf

                                                @if($p->precios->count())
                                                    <input type="hidden" name="precio_id" id="precio_{{ $p->id }}" value="{{ $p->precios[0]->id }}">
                                                @endif

                                                <input type="hidden" name="producto_id" value="{{ $p->id }}">

                                                <button type="submit" class="btn btn-success w-100">
                                                    <i class="fas fa-cart-plus"></i> AGREGAR
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <p class="text-center text-muted">No hay productos disponibles en esta categoría.</p>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- CARRITO -->
        @if (count(Cart::content()))
        <div class="col-sm-3 carrito-box">

            <h3 class="text-center text-warning">🛒 Resumen Carrito</h3>

            <table class="table table-striped">
                <tbody>
                    @foreach(Cart::content() as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->qty }} x {{ $item->price }}</td>
                            <td>{{ number_format($item->qty * $item->price, 2) }}</td>
                            <td>
                                <a href="/eliminaritem/{{ $item->rowId }}" class="text-decoration-none">🗑</a>
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="4" class="carrito-totales">
                            <p>Subtotal USD {{ Cart::subtotal() }}</p>
                            <p>Impuesto 15% USD {{ Cart::tax() }}</p>
                            <p class="fw-bold text-warning">TOTAL USD {{ Cart::total() }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p class="text-center mt-2">
                <a href="/vercarrito" class="btn btn-outline-success btn-sm">Ver Carrito</a>
            </p>
        </div>
        @endif

    </div>
</div>

<script>
    var selectprecios = document.querySelectorAll(".precios");

    selectprecios.forEach(element => {
        document.getElementById(element.id).addEventListener("change", e => {
            document.getElementById("txtprecio" + e.target.id).textContent =
                "USD " + e.target.value;

            document.getElementById("precio_" + e.target.id).value =
                element.options[element.selectedIndex].dataset.precioid;
        });
    });
</script>

@endsection
