@extends('layouts.app')

@section('title', 'Tambah Personel - Admin')

@section('content')
<div class="page-header">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.personel.index') }}">Data Personel</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
        <h1><i class="fas fa-user-plus"></i> Tambah Data Personel</h1>
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
                    <form action="{{ route('admin.personel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                           id="nama" name="nama" value="{{ old('nama') }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIP <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                           id="nip" name="nip" value="{{ old('nip') }}" required>
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
                                           id="pangkat" name="pangkat" value="{{ old('pangkat') }}" required>
                                    @error('pangkat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jabatan" class="form-label">Jabatan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                           id="jabatan" name="jabatan" value="{{ old('jabatan') }}" required>
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
                                           id="unit" name="unit" value="{{ old('unit') }}" required>
                                    @error('unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_telepon" class="form-label">No. Telepon</label>
                                    <input type="text" class="form-control @error('no_telepon') is-invalid @enderror"
                                           id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}">
                                    @error('no_telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                   id="foto" name="foto" accept="image/*">
                            <small class="form-text text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB</small>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror"
                                      id="catatan" name="catatan" rows="3">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
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
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informasi</h5>
                </div>
                <div class="card-body">
                    <p><strong>Pangkat Polisi:</strong></p>
                    <ul class="small">
                        <li>Aipda - Akpim Pendidikan Dinas</li>
                        <li>Aiptu - Akpim Pendidikan Tugas</li>
                        <li>Anda - Akpim Naik Dinas</li>
                        <li>Andtu - Akpim Naik Dinas Tugas</li>
                        <li>Bripka - Bripka Kepala</li>
                        <li>Briptu - Bripka Tugas</li>
                        <li>Iptu - Iptu Polisi</li>
                        <li>Ipda - Ipda Polisi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
