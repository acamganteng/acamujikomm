@extends('layouts.app')

@section('title', 'User Login - Jadwal Piket Polres Garut')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-5">
            <div class="card shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-shield-alt" style="font-size: 3rem; color: var(--color-primary);"></i>
                        <h2 class="mt-3" style="color: var(--color-primary);">Login</h2>
                        <p class="text-muted">Jadwal Piket Polres Garut</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>

                        <hr>

                        <p class="text-center text-muted mb-0">
                            Admin? <a href="{{ route('admin-login') }}" style="color: var(--color-secondary);">Login sebagai Admin</a>
                        </p>
                    </form>

                    <hr class="mt-3">

                    <div class="alert alert-info">
                        <strong>Demo Akun:</strong><br>
                        Email: <code>any@example.com</code><br>
                        Password: <code>user123</code>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
