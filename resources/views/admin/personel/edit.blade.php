@extends('layouts.app')

@section('title', 'Edit Personel - Admin')

@section('content')
<div class="page-header">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.personel.index') }}">Data Personel</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
        <h1><i class="fas fa-edit"></i> Edit Data Personel</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Form Data Personel</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.personel.update', $personel) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                           id="nama" name="nama" value="{{ old('nama', $personel->nama) }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIP <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                           id="nip" name="nip" value="{{ old('nip', $personel->nip) }}" required>
                                    @error('nip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pangkat" class="form-label">Pangkat <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('pangkat') is-invalid @enderror"
                                           id="pangkat" name="pangkat" value="{{ old('pangkat', $personel->pangkat) }}" required>
                                    @error('pangkat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jabatan" class="form-label">Jabatan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                           id="jabatan" name="jabatan" value="{{ old('jabatan', $personel->jabatan) }}" required>
                                    @error('jabatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="unit" class="form-label">Unit <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('unit') is-invalid @enderror"
                                           id="unit" name="unit" value="{{ old('unit', $personel->unit) }}" required>
                                    @error('unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_telepon" class="form-label">No. Telepon</label>
                                    <input type="text" class="form-control @error('no_telepon') is-invalid @enderror"
                                           id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $personel->no_telepon) }}">
                                    @error('no_telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror"
                                            id="status" name="status" required>
                                        <option value="aktif" {{ old('status', $personel->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="nonaktif" {{ old('status', $personel->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                           id="foto" name="foto" accept="image/*">
                                    <small class="form-text text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB</small>
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror"
                                      id="catatan" name="catatan" rows="3">{{ old('catatan', $personel->catatan) }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.personel.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-image"></i> Foto Profil</h5>
                </div>
                <div class="card-body text-center">
                    @if ($personel->foto)
                        <img src="{{ asset('storage/' . $personel->foto) }}"
                             alt="{{ $personel->nama }}"
                             class="img-fluid rounded"
                             style="max-width: 200px;">
                    @else
                        <div class="rounded d-inline-flex align-items-center justify-content-center"
                             style="width: 150px; height: 150px; background: var(--color-primary);">
                            <i class="fas fa-user" style="font-size: 3rem; color: #fff;"></i>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-history"></i> Info Sistem</h5>
                </div>
                <div class="card-body">
                    <p><strong>Dibuat:</strong><br>
                    {{ $personel->created_at->format('d M Y H:i') }}</p>
                    <p><strong>Diubah:</strong><br>
                    {{ $personel->updated_at->format('d M Y H:i') }}</p>
                    <p><strong>Total Jadwal:</strong><br>
                    {{ $personel->jadwalPiket()->count() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
