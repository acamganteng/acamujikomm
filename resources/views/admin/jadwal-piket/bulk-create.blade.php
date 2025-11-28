@extends('layouts.app')

@section('title', 'Bulk Jadwal Piket - Admin')

@section('content')
<div class="page-header">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.jadwal-piket.index') }}">Jadwal Piket</a></li>
                <li class="breadcrumb-item active">Bulk Create</li>
            </ol>
        </nav>
        <h1><i class="fas fa-tasks"></i> Bulk Membuat Jadwal Piket</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Form Bulk Jadwal</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.jadwal-piket.bulk-store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="personel_ids" class="form-label">Pilih Personel <span class="text-danger">*</span></label>
                            <select class="form-select @error('personel_ids') is-invalid @enderror"
                                    id="personel_ids" name="personel_ids[]" multiple required size="8">
                                @foreach ($personel as $p)
                                    <option value="{{ $p->id }}" {{ in_array($p->id, old('personel_ids', [])) ? 'selected' : '' }}>
                                        {{ $p->pangkat }} {{ $p->nama }} - {{ $p->unit }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Tahan Ctrl/Cmd untuk memilih multiple</small>
                            @error('personel_ids')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                           id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                           id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

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

                        <div class="mb-3">
                            <label class="form-label">Pilih Shift <span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="shifts[]" value="pagi"
                                       id="shift_pagi" {{ in_array('pagi', old('shifts', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="shift_pagi">
                                    Pagi (06:00 - 14:00)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="shifts[]" value="siang"
                                       id="shift_siang" {{ in_array('siang', old('shifts', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="shift_siang">
                                    Siang (14:00 - 22:00)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="shifts[]" value="malam"
                                       id="shift_malam" {{ in_array('malam', old('shifts', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="shift_malam">
                                    Malam (22:00 - 06:00)
                                </label>
                            </div>
                            @error('shifts')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Info:</strong> Sistem akan membuat jadwal piket untuk setiap personel yang dipilih,
                            untuk setiap hari dari tanggal mulai hingga tanggal selesai dengan shift yang dipilih secara random.
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Buat Jadwal
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
                    <h5 class="mb-0"><i class="fas fa-lightbulb"></i> Contoh Penggunaan</h5>
                </div>
                <div class="card-body">
                    <p><strong>Skenario 1: Jadwal Mingguan</strong></p>
                    <ul class="small">
                        <li>Pilih 5 personel</li>
                        <li>Tanggal Mulai: 1 Desember 2025</li>
                        <li>Tanggal Selesai: 7 Desember 2025</li>
                        <li>Tipe: Mingguan</li>
                        <li>Shift: Pagi, Siang, Malam</li>
                    </ul>
                    <p class="small text-muted">Hasil: 105 jadwal piket (5 personel × 7 hari × 3 shift)</p>

                    <hr>

                    <p><strong>Skenario 2: Jadwal Bulanan</strong></p>
                    <ul class="small">
                        <li>Pilih 3 personel</li>
                        <li>Tanggal Mulai: 1 Desember 2025</li>
                        <li>Tanggal Selesai: 31 Desember 2025</li>
                        <li>Tipe: Bulanan</li>
                        <li>Shift: Pagi saja</li>
                    </ul>
                    <p class="small text-muted">Hasil: 93 jadwal piket (3 personel × 31 hari)</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
