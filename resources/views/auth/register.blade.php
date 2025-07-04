@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #f8bbd0 0%, #ce93d8 100%);
        min-height: 100vh;
    }
    .salon-card {
        background: rgba(255,255,255,0.95);
        border-radius: 20px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        border: 1px solid #f3e5f5;
    }
    .salon-title {
        font-family: 'Segoe Script', cursive;
        color: #ad1457;
        letter-spacing: 1px;
    }
    .btn-salon {
        background: linear-gradient(90deg, #f06292 0%, #ba68c8 100%);
        border: none;
        color: #fff;
        font-weight: bold;
        border-radius: 25px;
        transition: background 0.3s;
    }
    .btn-salon:hover {
        background: linear-gradient(90deg, #ba68c8 0%, #f06292 100%);
        color: #fff;
    }
    .form-label {
        color: #8e24aa;
        font-weight: 500;
    }
    .link-salon {
        color: #ad1457;
        text-decoration: underline;
    }
    .link-salon:hover {
        color: #6a1b9a;
    }
</style>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card salon-card p-4" style="width: 400px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4 salon-title">Salon & Nail Art Register</h2>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="password"
                           name="password"
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password"
                           class="form-control"
                           id="password_confirmation"
                           name="password_confirmation"
                           required>
                </div>
                <button type="submit" class="btn btn-salon w-100">Register</button>
            </form>
            <div class="mt-3 text-center">
                <span>Sudah punya akun?</span>
                <a href="{{ route('login') }}" class="link-salon">Login di sini</a>
            </div>
        </div>
    </div>
</div>
@endsection