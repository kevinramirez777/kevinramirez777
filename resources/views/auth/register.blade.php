@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #000;
        color: #fff;
    }

    .register-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem; /* menos padding */
    }

    .register-card {
        display: flex;
        flex-direction: row;   /* 🔑 mitad y mitad */
        width: 900px;
        max-width: 100%;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(255, 96, 0, 1);
        background-color: #2a2a2a;
    }
.register-card {
    transform: scale(0.8);         /* 🔑 reduce todo el contenido al 80% */
    transform-origin: top center;  /* 🔑 mantiene el centrado visual */
}

    .register-left {
        width: 50%; /* 🔑 mitad exacta */
        background-image: url('/img/pizza.png');
        background-size: 70%;
        background-repeat: no-repeat;
        background-position: center center;
        background-color: #2a2a2a;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: center;
        padding: 1rem;
        text-align: center;
    }

    .register-left h2 {
        font-size: 1.5rem; /* más compacto */
        font-weight: bold;
        margin-bottom: 0.3rem;
        color: #fff;
    }

    .register-left p {
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        color: #fff;
    }

    .register-right {
        width: 50%; /* 🔑 la otra mitad */
        padding: 1.2rem; /* menos padding vertical */
        background-color: #1c1c1c;
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .register-right h4 {
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
    }

    .register-right p {
        font-size: 0.85rem;
        margin-bottom: 0.8rem;
    }

    .form-control {
        background-color: #333;
        color: #fff;
        border: none;
        font-size: 0.85rem;
        padding: 0.4rem 0.6rem;
    }

    .form-control:focus {
        background-color: #444;
        color: #fff;
        border-color: #ff6600;
        box-shadow: none;
    }

    .btn-register {
        background-color: #ff6600;
        border: none;
        color: #fff;
        font-size: 0.9rem;
        padding: 0.5rem;
    }

    .btn-register:hover {
        background-color: #e65c00;
    }

    a {
        color: #ff6600;
        font-size: 0.85rem;
    }

    /* Responsive: en pantallas pequeñas se apilan */
    @media (max-width: 768px) {
        .register-card {
            flex-direction: column;
            width: 100%;
        }
        .register-left, .register-right {
            width: 100%;
            height: auto;
        }
        .register-left {
            background-size: 50%;
            padding: 1rem;
        }
    }
</style>

<div class="container register-container">
    <div class="card register-card">
        <div class="register-left d-none d-md-flex">
            <h2>🍕 CAT'S PIZZA</h2>
            <p>Únete a nuestra familia de sabor.</p>
        </div>
        <div class="register-right">
            <h4>Crear cuenta ✨</h4>
            <p>Completa tus datos para registrarte.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-2">
                    <label for="name" class="form-label">Nombre completo</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                           name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="celular" class="form-label">Celular</label>
                    <input id="celular" type="text" class="form-control @error('celular') is-invalid @enderror"
                           name="celular" value="{{ old('celular') }}">
                    @error('celular')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror"
                           name="direccion" value="{{ old('direccion') }}">
                    @error('direccion')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="password" class="form-label">Contraseña</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required>
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="password-confirm" class="form-label">Confirmar contraseña</label>
                    <input id="password-confirm" type="password" class="form-control"
                           name="password_confirmation" required>
                </div>

                <div class="d-grid gap-2 mt-2">
                    <button type="submit" class="btn btn-register">Registrarme</button>
                </div>

                <div class="mt-2 text-center">
                    <a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
