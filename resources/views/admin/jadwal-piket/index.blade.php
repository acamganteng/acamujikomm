@extends('layouts.app')

@section('title', 'Manajemen Jadwal Piket - Admin')

@section('content')
<div class="page-header">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Jadwal Piket</li>
            </ol>
        </nav>
        <h1><i class="fas fa-calendar-alt"></i> Manajemen Jadwal Piket</h1>
    </div>
</div>

<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filter -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-filter"></i> Filter</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.jadwal-piket.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="cari" class="form-label">Cari Personel</label>
                    <input type="text" class="form-control" id="cari" name="cari"
                           placeholder="Nama" value="{{ request('cari') }}">
                </div>

                <div class="col-md-2">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal"
                           value="{{ request('tanggal') }}">
                </div>

                <div class="col-md-2">
                    <label for="unit" class="form-label">Unit</label>
                    <select class="form-select" id="unit" name="unit">
                        <option value="">Semua</option>
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
                        <option value="">Semua</option>
                        <option value="pagi" {{ request('shift') == 'pagi' ? 'selected' : '' }}>Pagi</option>
                        <option value="siang" {{ request('shift') == 'siang' ? 'selected' : '' }}>Siang</option>
                        <option value="malam" {{ request('shift') == 'malam' ? 'selected' : '' }}>Malam</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('admin.jadwal-piket.index') }}" class="btn btn-outline-secondary flex-grow-1">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="mb-3">
        <a href="{{ route('admin.jadwal-piket.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Jadwal Baru
        </a>
        <a href="{{ route('admin.jadwal-piket.bulk-create') }}" class="btn btn-info">
            <i class="fas fa-tasks"></i> Bulk Jadwal
        </a>
    </div>

    <!-- Jadwal List -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-list"></i> Daftar Jadwal Piket
                <span class="badge bg-secondary">{{ $jadwal->total() }} Data</span>
            </h5>
        </div>
        <div class="card-body">
            @if ($jadwal->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Personel</th>
                                <th>Pangkat</th>
                                <th>Unit</th>
                                <th>Shift</th>
                                <th>Tipe</th>
                                <th>Status Notif</th>
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
                                    <td><span class="badge bg-secondary">{{ $item->personel->pangkat }}</span></td>
                                    <td>{{ $item->personel->unit }}</td>
                                    <td>
                                        <span class="badge badge-shift-{{ $item->shift }}">
                                            {{ ucfirst($item->shift) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ ucfirst($item->tipe_piket) }}</span>
                                    </td>
                                    <td>
                                        @if ($item->notifikasi_dikirim)
                                            <span class="badge bg-success">
                                                <i class="fas fa-check"></i> Dikirim
                                            </span>
                                        @else
                                            <span class="badge bg-warning">
                                                <i class="fas fa-clock"></i> Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.jadwal-piket.edit', $item) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.jadwal-piket.destroy', $item) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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
                    <i class="fas fa-info-circle"></i> Tidak ada jadwal piket. <a href="{{ route('admin.jadwal-piket.create') }}">Buat jadwal baru</a>
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
