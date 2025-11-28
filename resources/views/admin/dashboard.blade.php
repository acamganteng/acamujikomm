@extends('layouts.app')

@section('title', 'Admin Dashboard - Jadwal Piket Polres Garut')

@section('content')
<div class="page-header">
    <div class="container-fluid">
        <h1><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h1>
        <p class="text-muted">Overview sistem manajemen jadwal piket</p>
    </div>
</div>

<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Stats Row 1 -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="stat-box stat-primary">
                <h3>{{ $totalPersonel }}</h3>
                <p><i class="fas fa-users"></i> Total Personel</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-box stat-primary">
                <h3>{{ $personelAktif }}</h3>
                <p><i class="fas fa-check-circle"></i> Personel Aktif</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-box stat-primary">
                <h3>{{ $totalJadwal }}</h3>
                <p><i class="fas fa-calendar-alt"></i> Total Jadwal</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-box stat-secondary">
                <h3>{{ $jadwalHariIni }}</h3>
                <p><i class="fas fa-calendar-day"></i> Jadwal Hari Ini</p>
            </div>
        </div>
    </div>

    <!-- Stats Row 2 -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="stat-box" style="background: linear-gradient(135deg, #17a2b8 0%, #0c5460 100%);">
                <h3>{{ $totalUser }}</h3>
                <p><i class="fas fa-user"></i> Total User</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-box" style="background: linear-gradient(135deg, #ffc107 0%, #cc9900 100%); color: #000;">
                <h3>{{ $totalAdmin }}</h3>
                <p><i class="fas fa-lock"></i> Total Admin</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-box" style="background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);">
                <h3>{{ $notifikasiPending }}</h3>
                <p><i class="fas fa-bell"></i> Notifikasi Pending</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-box" style="background: linear-gradient(135deg, #6c757d 0%, #545b62 100%);">
                <h3>{{ $jadwalMingguIni->count() }}</h3>
                <p><i class="fas fa-calendar-week"></i> Jadwal Minggu Ini</p>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Jadwal Minggu Ini -->
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-calendar-week"></i> Jadwal Minggu Ini</h5>
                </div>
                <div class="card-body">
                    @if ($jadwalMingguIni->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Personel</th>
                                        <th>Shift</th>
                                        <th>Tipe</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwalMingguIni->take(8) as $item)
                                        <tr>
                                            <td><strong>{{ $item->tanggal->format('d M') }}</strong></td>
                                            <td>{{ $item->personel->nama }}</td>
                                            <td>
                                                <span class="badge badge-shift-{{ $item->shift }}">
                                                    {{ ucfirst($item->shift) }}
                                                </span>
                                            </td>
                                            <td><span class="badge bg-info">{{ ucfirst($item->tipe_piket) }}</span></td>
                                            <td>
                                                <a href="{{ route('admin.jadwal-piket.edit', $item) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">Tidak ada jadwal minggu ini</p>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.jadwal-piket.index') }}" class="btn btn-sm btn-primary">
                        Lihat Semua Jadwal
                    </a>
                </div>
            </div>
        </div>

        <!-- Aksi Cepat -->
        <div class="col-lg-4 mb-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-bolt"></i> Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.jadwal-piket.create') }}" class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-plus"></i> Jadwal Baru
                    </a>
                    <a href="{{ route('admin.jadwal-piket.bulk-create') }}" class="btn btn-info w-100 mb-2">
                        <i class="fas fa-tasks"></i> Bulk Jadwal
                    </a>
                    <a href="{{ route('admin.personel.create') }}" class="btn btn-success w-100 mb-2">
                        <i class="fas fa-user-plus"></i> Personel Baru
                    </a>
                    <a href="{{ route('admin.personel.index') }}" class="btn btn-warning w-100">
                        <i class="fas fa-users"></i> Kelola Personel
                    </a>
                </div>
            </div>

            <!-- Jadwal Mendatang -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-clock"></i> Jadwal Mendatang</h5>
                </div>
                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                    @forelse ($jadwalMendatang as $item)
                        <div class="mb-2 pb-2" style="border-bottom: 1px solid #eee;">
                            <strong>{{ $item->tanggal->format('d M Y') }}</strong><br>
                            <small>{{ $item->personel->nama }}</small><br>
                            <small class="text-muted">{{ $item->personel->unit }}</small>
                        </div>
                    @empty
                        <p class="text-muted">Tidak ada jadwal mendatang</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Piket Per Unit Chart -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Statistik Piket Per Unit</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($piketPerUnit as $unit => $count)
                            <div class="col-md-3 mb-3">
                                <div style="background: rgba(212, 175, 55, 0.1); padding: 15px; border-radius: 8px; border-left: 4px solid var(--color-secondary);">
                                    <strong>{{ $unit }}</strong><br>
                                    <h4 style="color: var(--color-primary); margin-top: 5px;">{{ $count }}</h4>
                                    <small class="text-muted">Jadwal Piket</small>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted">Belum ada data piket</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-css')
<style>
    .badge-shift-pagi {
        background-color: #28a745 !important;
    }
    .badge-shift-siang {
        background-color: #ffc107 !important;
        color: #000 !important;
    }
    .badge-shift-malam {
        background-color: #001f3f !important;
    }
</style>
@endsection
