@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #000;
        color: #fff;
    }

    .login-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .login-card {
        display: flex;
        flex-direction: row;
        width: 900px;
        max-width: 100%;
        height: 520px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(255, 96, 0, 1);
        background-color: #2a2a2a;
    }
.login-card {
    transform: scale(0.9);         /* 🔑 reduce todo el contenido al 80% */
    transform-origin: top center;  /* 🔑 mantiene el centrado visual */
}

    .login-left {
    width: 50%;
    height: 100%;
    background-image: url('/img/pizza.png');
    background-size: 75%; /* reduce tamaño de imagen al 70% */
    background-repeat: no-repeat;
    background-position: center center;
    background-color: #2a2a2a;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    align-items: center;
    padding: 1.5rem;
    text-align: center;
}

    .login-left h2 {
        font-size: 1.8rem;
        font-weight: bold;
        margin-top: auto;
        margin-bottom: 0.5rem;
        color: #fff;
    }

    .login-left p {
        font-size: 1rem;
        margin-bottom: 1rem;
        color: #fff;
    }

    .login-right {
        width: 50%;
        padding: 2rem;
        background-color: #1c1c1c;
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-right h4,
    .login-right p,
    .login-right label {
        color: #ffffff;
    }

    .form-control {
        background-color: #333;
        color: #fff;
        border: none;
    }

    .form-control:focus {
        background-color: #444;
        color: #fff;
        border-color: #ff6600;
        box-shadow: none;
    }

    .btn-login {
        background-color: #ff6600;
        border: none;
        color: #fff;
    }

    .btn-login:hover {
        background-color: #e65c00;
    }

    a {
        color: #ff6600;
    }
</style>

<div class="container login-container">
    <div class="card login-card">
        <div class="login-left d-none d-md-flex">
            <h2>🍕 CAT'S PIZZA</h2>
            <p>Satisfacemos tus antojos con sabor auténtico.</p>
        </div>
        <div class="login-right">
            <h4 class="mb-4">Bienvenido 👋</h4>
            <p class="mb-4">Ingresa tu correo y contraseña para acceder.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required>
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                           {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Recordarme</label>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-login">Iniciar sesión</button>
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                    @endif
                    <a href="{{ route('register') }}">¿No tienes cuenta? Regístrate</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
