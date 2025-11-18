@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #000;
        color: #fff;
    }

    .catalogo-banner {
        background-color: #ff4500;
        padding: 1rem;
        text-align: center;
        box-shadow: 0 0 20px rgba(255, 96, 0, 0.8);
    }

    .catalogo-banner img {
        max-height: 280px;
        object-fit: contain;
        border-radius: 12px;
    }

    .catalogo-title {
        color: #ffffff;
        font-weight: bold;
        font-size: 1.8rem;
        margin-top: 2rem;
        margin-bottom: 1rem;
        text-align: center;
    }

    .card {
        background-color: #2a2a2a;
        border: none;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(255, 96, 0, 0.4);
        transition: transform 0.2s ease;
    }

    .card:hover {
        transform: scale(1.03);
    }

    .card-img-top {
        height: 160px;
        object-fit: cover;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .card-body {
        padding: 0.8rem;
        text-align: center;
    }

    .card-body p {
        color: #fff;
        font-size: 1rem;
        font-weight: bold;
        margin-bottom: 0;
    }

    .card-footer {
        background-color: #1c1c1c;
        border-top: none;
        padding: 0.8rem;
    }

    .btn-pizza {
        background-color: transparent;
        border: 2px solid #ff4500;
        color: #ffffff;
        font-weight: bold;
        width: 100%;
        transition: all 0.3s ease;
    }

    .btn-pizza:hover {
        background-color: #ff6600;
        color: #fff;
    }

    /* Responsive ajustes */
    @media (max-width: 576px) {
        .card-img-top {
            height: 120px;
        }
        .catalogo-title {
            font-size: 1.4rem;
        }
    }
</style>

<div class="container-fluid catalogo-banner">
    <img src="/img/z4.png" alt="Pide tu pizza" class="img-fluid mx-auto d-block">
</div>

<div class="container">
    <h1 class="catalogo-title">¡Pide ahora tu pizza en CAT'S!</h1>
    <div class="row justify-content-center">
        @foreach ($productos as $i)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100">
                    <img src="/img/{{ $i->urlfoto }}" class="card-img-top" alt="{{ $i->nombre }}">
                    <div class="card-body">
                        <!-- Precio con ícono de moneda -->
                        <p><i class="fas fa-money-bill-wave"></i> C$ {{ number_format($i->precio, 2) }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="/catalogo/{{ $i->slug }}" class="btn btn-pizza">
                            {{ $i->nombre }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
