<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jadwal Piket Polres Garut')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --color-primary: #001f3f;
            --color-secondary: #d4af37;
            --color-light: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--color-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--color-primary) 0%, #003d66 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-bottom: 3px solid var(--color-secondary);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.3rem;
            color: var(--color-secondary) !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link {
            color: #fff !important;
            transition: all 0.3s;
            position: relative;
        }

        .nav-link:hover {
            color: var(--color-secondary) !important;
        }

        .nav-link.active {
            color: var(--color-secondary) !important;
        }

        /* Sidebar */
        .sidebar {
            background: var(--color-primary);
            color: #fff;
            min-height: calc(100vh - 56px);
            position: fixed;
            left: 0;
            top: 56px;
            width: 250px;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link {
            color: #ccc !important;
            padding: 12px 20px !important;
            border-left: 3px solid transparent;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: rgba(212, 175, 55, 0.1);
            color: var(--color-secondary) !important;
            border-left-color: var(--color-secondary);
        }

        .sidebar .nav-title {
            padding: 15px 20px;
            font-size: 0.85rem;
            font-weight: bold;
            color: var(--color-secondary);
            text-transform: uppercase;
            margin-top: 10px;
        }

        /* Main content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: calc(100vh - 56px);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Header section */
        .page-header {
            background: linear-gradient(135deg, var(--color-primary) 0%, #003d66 100%);
            color: #fff;
            padding: 30px 0;
            margin-bottom: 30px;
            border-bottom: 3px solid var(--color-secondary);
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: bold;
        }

        .page-header .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 10px;
        }

        .page-header .breadcrumb-item.active {
            color: var(--color-secondary);
        }

        /* Card styling */
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            transition: all 0.3s;
        }

        .card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        .card-header {
            background: linear-gradient(135deg, var(--color-primary) 0%, #003d66 100%);
            color: #fff;
            border-radius: 10px 10px 0 0 !important;
            border: none;
            font-weight: bold;
        }

        .card-header-secondary {
            background: var(--color-secondary);
            color: var(--color-primary);
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
        }

        .btn-primary:hover {
            background-color: #001530;
            border-color: #001530;
        }

        .btn-secondary {
            background-color: var(--color-secondary);
            border-color: var(--color-secondary);
            color: var(--color-primary);
            font-weight: bold;
        }

        .btn-secondary:hover {
            background-color: #c59e2b;
            border-color: #c59e2b;
        }

        /* Badges */
        .badge-shift-pagi {
            background-color: #28a745;
        }

        .badge-shift-siang {
            background-color: #ffc107;
            color: #000;
        }

        .badge-shift-malam {
            background-color: #001f3f;
        }

        /* Tables */
        .table {
            color: #333;
        }

        .table thead {
            background: linear-gradient(135deg, var(--color-primary) 0%, #003d66 100%);
            color: #fff;
        }

        .table tbody tr {
            transition: all 0.2s;
        }

        .table tbody tr:hover {
            background-color: rgba(212, 175, 55, 0.08);
        }

        /* Alerts */
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        /* Forms */
        .form-control, .form-select {
            border-color: #ddd;
            border-radius: 6px;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 0.2rem rgba(0, 31, 63, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: var(--color-primary);
        }

        /* Stats box */
        .stat-box {
            padding: 20px;
            border-radius: 10px;
            color: #fff;
            text-align: center;
        }

        .stat-box h3 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .stat-box p {
            font-size: 0.95rem;
            margin: 0;
        }

        .stat-primary {
            background: linear-gradient(135deg, var(--color-primary) 0%, #003d66 100%);
        }

        .stat-secondary {
            background: linear-gradient(135deg, var(--color-secondary) 0%, #c59e2b 100%);
            color: var(--color-primary);
        }

        /* Footer */
        footer {
            background: var(--color-primary);
            color: #fff;
            padding: 20px 0;
            text-align: center;
            margin-top: 30px;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .page-header h1 {
                font-size: 1.5rem;
            }

            .main-content {
                padding: 10px;
            }

            .stat-box h3 {
                font-size: 1.8rem;
            }
        }
    </style>
    @yield('extra-css')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-shield-alt"></i> Polres Garut
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <span class="nav-link">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </span>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link" style="border: none; cursor: pointer;">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> User Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin-login') }}">
                                <i class="fas fa-lock"></i> Admin Login
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        @auth
            <nav class="sidebar">
                @if(Auth::user()->isAdmin())
                    <div class="nav-title">Admin Panel</div>
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>

                    <div class="nav-title mt-3">Manajemen</div>
                    <a class="nav-link {{ request()->routeIs('admin.jadwal-piket.*') ? 'active' : '' }}"
                       href="{{ route('admin.jadwal-piket.index') }}">
                        <i class="fas fa-calendar-alt"></i> Jadwal Piket
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.personel.*') ? 'active' : '' }}"
                       href="{{ route('admin.personel.index') }}">
                        <i class="fas fa-users"></i> Data Personel
                    </a>

                    <div class="nav-title mt-3">Tools</div>
                    <a class="nav-link" href="{{ route('admin.jadwal-piket.bulk-create') }}">
                        <i class="fas fa-tasks"></i> Bulk Jadwal
                    </a>
                @else
                    <div class="nav-title">User Menu</div>
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard') }}">
                        <i class="fas fa-calendar-check"></i> Jadwal Piket
                    </a>
                @endif
            </nav>

            <main class="main-content flex-grow-1">
                @yield('content')
            </main>
        @else
            <main style="width: 100%;">
                @yield('content')
            </main>
        @endauth
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Jadwal Piket Polres Garut. All rights reserved.</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
    @yield('extra-js')
</body>
</html>
