@extends('layouts.app')

@section('title', 'Tambah Jadwal Piket - Admin')

@section('content')
<div class="page-header">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.jadwal-piket.index') }}">Jadwal Piket</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
        <h1><i class="fas fa-plus"></i> Tambah Jadwal Piket</h1>
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
                    <form action="{{ route('admin.jadwal-piket.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="personel_id" class="form-label">Personel <span class="text-danger">*</span></label>
                            <select class="form-select @error('personel_id') is-invalid @enderror"
                                    id="personel_id" name="personel_id" required>
                                <option value="">-- Pilih Personel --</option>
                                @foreach ($personel as $p)
                                    <option value="{{ $p->id }}" {{ old('personel_id') == $p->id ? 'selected' : '' }}>
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
                                           id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
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
                                        <option value="pagi" {{ old('shift') == 'pagi' ? 'selected' : '' }}>Pagi (06:00 - 14:00)</option>
                                        <option value="siang" {{ old('shift') == 'siang' ? 'selected' : '' }}>Siang (14:00 - 22:00)</option>
                                        <option value="malam" {{ old('shift') == 'malam' ? 'selected' : '' }}>Malam (22:00 - 06:00)</option>
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
                                        <option value="harian" {{ old('tipe_piket') == 'harian' ? 'selected' : '' }}>Harian</option>
                                        <option value="mingguan" {{ old('tipe_piket') == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                                        <option value="bulanan" {{ old('tipe_piket') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
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
                                           id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
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
                                      placeholder="Catatan tambahan">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
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
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informasi</h5>
                </div>
                <div class="card-body">
                    <p><strong>Jam Shift:</strong></p>
                    <ul class="list-unstyled">
                        <li><span class="badge bg-success">Pagi</span> 06:00 - 14:00</li>
                        <li><span class="badge bg-warning text-dark">Siang</span> 14:00 - 22:00</li>
                        <li><span class="badge bg-dark">Malam</span> 22:00 - 06:00</li>
                    </ul>

                    <hr>

                    <p><strong>Tipe Piket:</strong></p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check"></i> Harian - 1 hari</li>
                        <li><i class="fas fa-check"></i> Mingguan - 7 hari</li>
                        <li><i class="fas fa-check"></i> Bulanan - 30 hari</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
