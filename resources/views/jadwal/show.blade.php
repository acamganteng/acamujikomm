@extends('layouts.app')

@section('title', 'Detail Jadwal - Jadwal Piket Polres Garut')

@section('content')
<div class="page-header">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Jadwal</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
        <h1><i class="fas fa-eye"></i> Detail Jadwal Piket</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Jadwal</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Tanggal Piket:</strong></p>
                            <p class="h5">{{ $jadwal->tanggal->format('d MMMM Y') }} ({{ $jadwal->tanggal->format('l') }})</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Shift:</strong></p>
                            <p>
                                <span class="badge badge-shift-{{ $jadwal->shift }}" style="font-size: 1rem; padding: 8px 12px;">
                                    {{ strtoupper($jadwal->shift) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Tipe Piket:</strong></p>
                            <p class="badge bg-info">{{ ucfirst($jadwal->tipe_piket) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Lokasi:</strong></p>
                            <p>{{ $jadwal->lokasi ?? '-' }}</p>
                        </div>
                    </div>

                    @if ($jadwal->catatan)
                        <div class="row">
                            <div class="col-12">
                                <p><strong>Catatan:</strong></p>
                                <p>{{ $jadwal->catatan }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Personel Piket</h5>
                </div>
                <div class="card-body text-center">
                    @if ($jadwal->personel->foto)
                        <img src="{{ asset('storage/' . $jadwal->personel->foto) }}"
                             alt="{{ $jadwal->personel->nama }}"
                             class="img-fluid rounded-circle mb-3"
                             style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <div class="rounded-circle mb-3"
                             style="width: 150px; height: 150px; background: var(--color-primary); margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user" style="font-size: 3rem; color: #fff;"></i>
                        </div>
                    @endif

                    <h5 class="mb-1">{{ $jadwal->personel->nama }}</h5>
                    <p class="text-muted">{{ $jadwal->personel->pangkat }}</p>

                    <hr>

                    <p><strong>Jabatan:</strong> {{ $jadwal->personel->jabatan }}</p>
                    <p><strong>Unit:</strong> {{ $jadwal->personel->unit }}</p>
                    <p><strong>NIP:</strong> {{ $jadwal->personel->nip }}</p>

                    @if ($jadwal->personel->no_telepon)
                        <p><strong>Telepon:</strong> {{ $jadwal->personel->no_telepon }}</p>
                    @endif

                    <p>
                        <span class="badge bg-success">{{ ucfirst($jadwal->personel->status) }}</span>
                    </p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Info Notifikasi</h5>
                </div>
                <div class="card-body">
                    @if ($jadwal->notifikasi_dikirim)
                        <p class="mb-0">
                            <span class="badge bg-success">Notifikasi Terkirim</span><br>
                            <small class="text-muted">{{ $jadwal->notifikasi_waktu->format('d M Y H:i') }}</small>
                        </p>
                    @else
                        <p class="mb-0">
                            <span class="badge bg-warning">Belum Dikirim</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

@endsection

@section('extra-css')
<style>
    .badge-shift-pagi {
        background-color: #28a745 !important;
        padding: 8px 12px !important;
    }
    .badge-shift-siang {
        background-color: #ffc107 !important;
        color: #000 !important;
        padding: 8px 12px !important;
    }
    .badge-shift-malam {
        background-color: #001f3f !important;
        padding: 8px 12px !important;
    }
</style>
@endsection
