@extends('layouts.app')

@section('title', 'Admin Login - Jadwal Piket Polres Garut')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-5">
            <div class="card shadow-lg" style="border-top: 4px solid var(--color-secondary);">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-lock" style="font-size: 3rem; color: var(--color-secondary);"></i>
                        <h2 class="mt-3" style="color: var(--color-primary);">Admin Login</h2>
                        <p class="text-muted">Panel Administrasi</p>
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

                    <form action="{{ route('admin-login.post') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Admin</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-secondary w-100 mb-3">
                            <i class="fas fa-sign-in-alt"></i> Login Admin
                        </button>

                        <hr>

                        <p class="text-center text-muted mb-0">
                            User? <a href="{{ route('login') }}" style="color: var(--color-primary);">Login sebagai User</a>
                        </p>
                    </form>

                    <hr class="mt-3">

                    <div class="alert alert-info">
                        <strong>Demo Admin:</strong><br>
                        Email: <code>admin@polres.garut.id</code><br>
                        Password: <code>admin123</code>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
