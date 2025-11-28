@extends('layouts.app')

@section('title', 'Detail Personel - Admin')

@section('content')
<div class="page-header">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.personel.index') }}">Data Personel</a></li>
                <li class="breadcrumb-item active">{{ $personel->nama }}</li>
            </ol>
        </nav>
        <h1><i class="fas fa-user"></i> Detail Personel</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-3 text-center">
                @if ($personel->foto)
                    <img src="{{ asset('storage/' . $personel->foto) }}"
                         alt="{{ $personel->nama }}"
                         class="card-img-top rounded-top"
                         style="height: 300px; object-fit: cover;">
                @else
                    <div class="card-img-top bg-primary d-flex align-items-center justify-content-center"
                         style="height: 300px;">
                        <i class="fas fa-user" style="font-size: 5rem; color: #fff;"></i>
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $personel->nama }}</h5>
                    <p class="card-text text-muted">{{ $personel->pangkat }}</p>
                    <p>
                        <span class="badge {{ $personel->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($personel->status) }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Aksi</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.personel.edit', $personel) }}" class="btn btn-warning w-100 mb-2">
                        <i class="fas fa-edit"></i> Edit Data
                    </a>
                    <form action="{{ route('admin.personel.destroy', $personel) }}" method="POST" class="d-inline w-100"
                          onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100 mb-2">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                    <a href="{{ route('admin.personel.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Informasi Dasar -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Dasar</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nama Lengkap:</strong></p>
                            <p>{{ $personel->nama }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>NIP:</strong></p>
                            <p><code>{{ $personel->nip }}</code></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Pangkat:</strong></p>
                            <p>{{ $personel->pangkat }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Jabatan:</strong></p>
                            <p>{{ $personel->jabatan }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Unit:</strong></p>
                            <p>{{ $personel->unit }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>No. Telepon:</strong></p>
                            <p>{{ $personel->no_telepon ?? '-' }}</p>
                        </div>
                    </div>

                    @if ($personel->catatan)
                        <div class="row">
                            <div class="col-12">
                                <p><strong>Catatan:</strong></p>
                                <p>{{ $personel->catatan }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Jadwal Piket -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-alt"></i> Jadwal Piket Mendatang
                        <span class="badge bg-secondary">{{ $jadwal->count() }}</span>
                    </h5>
                </div>
                <div class="card-body">
                    @if ($jadwal->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Shift</th>
                                        <th>Tipe</th>
                                        <th>Lokasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal as $j)
                                        <tr>
                                            <td>
                                                <strong>{{ $j->tanggal->format('d M Y') }}</strong><br>
                                                <small class="text-muted">{{ $j->tanggal->format('l') }}</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-shift-{{ $j->shift }}">
                                                    {{ ucfirst($j->shift) }}
                                                </span>
                                            </td>
                                            <td><span class="badge bg-info">{{ ucfirst($j->tipe_piket) }}</span></td>
                                            <td>{{ $j->lokasi ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('admin.jadwal-piket.edit', $j) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">Tidak ada jadwal piket yang akan datang</p>
                    @endif
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
