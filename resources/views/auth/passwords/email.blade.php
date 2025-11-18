@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #000;
        color: #fff;
    }

    .reset-container {
        min-height: 77vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .reset-card {
        width: 600px;
        max-width: 100%;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(255, 96, 0, 1);
       /* background-color: #2a2a2a;*/
        padding: 2rem;
    }

    .reset-card h4 {
        font-size: 1.5rem;
        font-weight: bold;
        color: #ff6600;
        margin-bottom: 1rem;
        text-align: center;
    }

    .form-label {
        color: #fff;
        font-weight: 500;
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

    .btn-reset {
        background-color: #ff6600;
        border: none;
        color: #fff;
        font-weight: bold;
        padding: 0.5rem 1rem;
        width: 100%;
    }

    .btn-reset:hover {
        background-color: #e65c00;
    }

    .alert-success {
        background-color: #28a745;
        color: #fff;
        border: none;
    }

   /* .text-danger {
        font-size: 0.85rem;
    }*/
</style>

<div class="reset-container">
    <div class="reset-card">
        <h4>🔒 Restablecer contraseña</h4>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-reset">
                    Enviar enlace de recuperación
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
