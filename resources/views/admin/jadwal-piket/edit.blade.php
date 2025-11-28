@extends('layouts.app')

@section('title', 'Edit Jadwal Piket - Admin')

@section('content')
<div class="page-header">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.jadwal-piket.index') }}">Jadwal Piket</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
        <h1><i class="fas fa-edit"></i> Edit Jadwal Piket</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Form Jadwal Piket</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.jadwal-piket.update', $jadwal) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="personel_id" class="form-label">Personel <span class="text-danger">*</span></label>
                            <select class="form-select @error('personel_id') is-invalid @enderror"
                                    id="personel_id" name="personel_id" required>
                                <option value="">-- Pilih Personel --</option>
                                @foreach ($personel as $p)
                                    <option value="{{ $p->id }}" {{ old('personel_id', $jadwal->personel_id) == $p->id ? 'selected' : '' }}>
                                        {{ $p->pangkat }} {{ $p->nama }} - {{ $p->unit }}
                                    </option>
                                @endforeach
                            </select>
                            @error('personel_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                           id="tanggal" name="tanggal" value="{{ old('tanggal', $jadwal->tanggal->format('Y-m-d')) }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="shift" class="form-label">Shift <span class="text-danger">*</span></label>
                                    <select class="form-select @error('shift') is-invalid @enderror"
                                            id="shift" name="shift" required>
                                        <option value="">-- Pilih Shift --</option>
                                        <option value="pagi" {{ old('shift', $jadwal->shift) == 'pagi' ? 'selected' : '' }}>Pagi (06:00 - 14:00)</option>
                                        <option value="siang" {{ old('shift', $jadwal->shift) == 'siang' ? 'selected' : '' }}>Siang (14:00 - 22:00)</option>
                                        <option value="malam" {{ old('shift', $jadwal->shift) == 'malam' ? 'selected' : '' }}>Malam (22:00 - 06:00)</option>
                                    </select>
                                    @error('shift')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tipe_piket" class="form-label">Tipe Piket <span class="text-danger">*</span></label>
                                    <select class="form-select @error('tipe_piket') is-invalid @enderror"
                                            id="tipe_piket" name="tipe_piket" required>
                                        <option value="">-- Pilih Tipe --</option>
                                        <option value="harian" {{ old('tipe_piket', $jadwal->tipe_piket) == 'harian' ? 'selected' : '' }}>Harian</option>
                                        <option value="mingguan" {{ old('tipe_piket', $jadwal->tipe_piket) == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                                        <option value="bulanan" {{ old('tipe_piket', $jadwal->tipe_piket) == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                                    </select>
                                    @error('tipe_piket')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lokasi" class="form-label">Lokasi</label>
                                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                           id="lokasi" name="lokasi" value="{{ old('lokasi', $jadwal->lokasi) }}"
                                           placeholder="Tempat piket">
                                    @error('lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror"
                                      id="catatan" name="catatan" rows="3"
                                      placeholder="Catatan tambahan">{{ old('catatan', $jadwal->catatan) }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.jadwal-piket.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-history"></i> Informasi Jadwal</h5>
                </div>
                <div class="card-body">
                    <p><strong>Dibuat:</strong><br>
                    {{ $jadwal->created_at->format('d M Y H:i') }}</p>
                    <p><strong>Diubah:</strong><br>
                    {{ $jadwal->updated_at->format('d M Y H:i') }}</p>

                    @if ($jadwal->notifikasi_dikirim)
                        <hr>
                        <p><strong>Status Notifikasi:</strong><br>
                        <span class="badge bg-success">Sudah Dikirim</span><br>
                        {{ $jadwal->notifikasi_waktu->format('d M Y H:i') }}</p>
                    @else
                        <hr>
                        <p><strong>Status Notifikasi:</strong><br>
                        <span class="badge bg-warning">Belum Dikirim</span></p>
                    @endif
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Detail Personel</h5>
                </div>
                <div class="card-body">
                    @if ($jadwal->personel->foto)
                        <img src="{{ asset('storage/' . $jadwal->personel->foto) }}"
                             alt="{{ $jadwal->personel->nama }}"
                             class="img-fluid rounded mb-2">
                    @endif
                    <p><strong>{{ $jadwal->personel->pangkat }} {{ $jadwal->personel->nama }}</strong></p>
                    <p><small>{{ $jadwal->personel->jabatan }}<br>{{ $jadwal->personel->unit }}</small></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
