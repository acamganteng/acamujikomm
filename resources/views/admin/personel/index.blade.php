@extends('layouts.app')

@section('title', 'Manajemen Data Personel - Admin')

@section('content')
<div class="page-header">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Data Personel</li>
            </ol>
        </nav>
        <h1><i class="fas fa-users"></i> Manajemen Data Personel</h1>
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
            <form action="{{ route('admin.personel.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="cari" class="form-label">Cari</label>
                    <input type="text" class="form-control" id="cari" name="cari"
                           placeholder="Nama atau NIP" value="{{ request('cari') }}">
                </div>

                <div class="col-md-3">
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
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Semua</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('admin.personel.index') }}" class="btn btn-outline-secondary flex-grow-1">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="mb-3">
        <a href="{{ route('admin.personel.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Tambah Personel
        </a>
    </div>

    <!-- Personel List -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-list"></i> Daftar Personel
                <span class="badge bg-secondary">{{ $personel->total() }} Data</span>
            </h5>
        </div>
        <div class="card-body">
            @if ($personel->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Pangkat</th>
                                <th>Jabatan</th>
                                <th>Unit</th>
                                <th>NIP</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($personel as $item)
                                <tr>
                                    <td>{{ ($personel->currentPage() - 1) * $personel->perPage() + $loop->iteration }}</td>
                                    <td>
                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}"
                                                 alt="{{ $item->nama }}"
                                                 class="rounded"
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="rounded d-inline-flex align-items-center justify-content-center"
                                                 style="width: 40px; height: 40px; background: var(--color-primary); color: #fff;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td><strong>{{ $item->nama }}</strong></td>
                                    <td><span class="badge bg-secondary">{{ $item->pangkat }}</span></td>
                                    <td>{{ $item->jabatan }}</td>
                                    <td>{{ $item->unit }}</td>
                                    <td><code>{{ $item->nip }}</code></td>
                                    <td>
                                        @if ($item->status == 'aktif')
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.personel.show', $item) }}" class="btn btn-sm btn-info" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.personel.edit', $item) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.personel.destroy', $item) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
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
                    {{ $personel->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Tidak ada data personel. <a href="{{ route('admin.personel.create') }}">Tambah personel baru</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
