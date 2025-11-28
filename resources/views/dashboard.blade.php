@extends('layouts.app')

@section('title', 'Dashboard - Jadwal Piket Polres Garut')

@section('content')
<div class="page-header">
    <div class="container-fluid">
        <h1><i class="fas fa-calendar-check"></i> Jadwal Piket Polres Garut</h1>
        <p class="text-muted">Lihat jadwal piket personel Polres Garut</p>
    </div>
</div>

<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Jadwal Hari Ini -->
    @if ($todaySchedule->count() > 0)
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-left-4" style="border-left: 4px solid var(--color-secondary);">
                    <div class="card-header card-header-secondary">
                        <h5 class="mb-0"><i class="fas fa-calendar-day"></i> Jadwal Hari Ini</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($todaySchedule as $item)
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card border-0" style="background: rgba(212, 175, 55, 0.05);">
                                        <div class="card-body">
                                            <h6 class="card-title">
                                                {{ $item->personel->pangkat }} {{ $item->personel->nama }}
                                            </h6>
                                            <p class="card-text mb-2">
                                                <small><strong>Jabatan:</strong> {{ $item->personel->jabatan }}</small><br>
                                                <strong>Unit:</strong> {{ $item->personel->unit }}
                                            </p>
                                            <div>
                                                <span class="badge badge-shift-{{ $item->shift }}">
                                                    {{ ucfirst($item->shift) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Filter Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-filter"></i> Filter Jadwal</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="cari" class="form-label">Cari Personel</label>
                    <input type="text" class="form-control" id="cari" name="cari"
                           placeholder="Nama atau Pangkat" value="{{ request('cari') }}">
                </div>

                <div class="col-md-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal"
                           value="{{ request('tanggal') }}">
                </div>

                <div class="col-md-2">
                    <label for="unit" class="form-label">Unit</label>
                    <select class="form-select" id="unit" name="unit">
                        <option value="">Semua Unit</option>
                        @foreach ($units as $u)
                            <option value="{{ $u }}" {{ request('unit') == $u ? 'selected' : '' }}>
                                {{ $u }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="shift" class="form-label">Shift</label>
                    <select class="form-select" id="shift" name="shift">
                        <option value="">Semua Shift</option>
                        <option value="pagi" {{ request('shift') == 'pagi' ? 'selected' : '' }}>Pagi</option>
                        <option value="siang" {{ request('shift') == 'siang' ? 'selected' : '' }}>Siang</option>
                        <option value="malam" {{ request('shift') == 'malam' ? 'selected' : '' }}>Malam</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Jadwal List -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-list"></i> Jadwal Piket
                <span class="badge bg-secondary">{{ $jadwal->total() }} Data</span>
            </h5>
        </div>
        <div class="card-body">
            @if ($jadwal->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Personel</th>
                                <th>Pangkat</th>
                                <th>Unit</th>
                                <th>Shift</th>
                                <th>Tipe</th>
                                <th>Lokasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $item)
                                <tr>
                                    <td>{{ ($jadwal->currentPage() - 1) * $jadwal->perPage() + $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $item->tanggal->format('d M Y') }}</strong><br>
                                        <small class="text-muted">{{ $item->tanggal->format('l') }}</small>
                                    </td>
                                    <td>{{ $item->personel->nama }}</td>
                                    <td><span class="badge bg-primary">{{ $item->personel->pangkat }}</span></td>
                                    <td>{{ $item->personel->unit }}</td>
                                    <td>
                                        <span class="badge badge-shift-{{ $item->shift }}">
                                            {{ ucfirst($item->shift) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ ucfirst($item->tipe_piket) }}</span>
                                    </td>
                                    <td>{{ $item->lokasi ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('jadwal.show', $item) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $jadwal->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Tidak ada jadwal piket yang ditemukan.
                </div>
            @endif
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
