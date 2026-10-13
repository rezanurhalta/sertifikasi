@extends('layouts.app')

@section('content')
{{-- 
    PENJELASAN UNTUK ASESOR:
    Form ini digunakan untuk menambahkan data Skema Sertifikasi baru.
    Kolom Jenis Skema menggunakan elemen <select> dropdown untuk memastikan konsistensi data.
--}}
<div class="card shadow-sm border-0 col-md-8 mx-auto">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Tambah Skema Sertifikasi</h5>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('skema.store') }}" method="POST">
            @csrf
            
            {{-- Input Kode Skema --}}
      <div class="mb-3">
                <label class="form-label fw-semibold">Kode Skema</label>
                <input type="text" name="kd_skema" class="form-control @error('kd_skema') is-invalid @enderror" value="{{ old('kd_skema') }}" placeholder="Pilih atau ketik kode skema" list="listKodeSkema" required>
                
                {{-- Daftar pilihan otomatis untuk Kode Skema --}}
                <datalist id="listKodeSkema">
                    <option value="SKM-001">
                    <option value="SKM-002">
                    <option value="SKM-003">
                    <option value="SKM-004">
                    <option value="SKM-005">
                </datalist>

                @error('kd_skema') 
                    <div class="invalid-feedback fw-bold">{{ $message }}</div> 
                @enderror
            </div>

            {{-- Input Nama Skema --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Skema</label>
                <input type="text" name="nm_skema" class="form-control @error('nm_skema') is-invalid @enderror" value="{{ old('nm_skema') }}"  required>
                @error('nm_skema') 
                    <div class="invalid-feedback fw-bold">{{ $message }}</div> 
                @enderror
            </div>

            {{-- Dropdown Jenis Skema (Sudah Ditentukan) --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Jenis Skema</label>
                <select name="jenis" class="form-select @error('jenis') is-invalid @enderror" required>
                    <option value="">-- Pilih Jenis Skema --</option>
                    <option value="KKNI" {{ old('jenis') == 'KKNI' ? 'selected' : '' }}>KKNI</option>
                    <option value="Klaster" {{ old('jenis') == 'Klaster' ? 'selected' : '' }}>Klaster</option>
                    <option value="Okupasi" {{ old('jenis') == 'Okupasi' ? 'selected' : '' }}>Okupasi</option>
                    <option value="Unit Kompetensi" {{ old('jenis') == 'Unit Kompetensi' ? 'selected' : '' }}>Unit Kompetensi</option>
                </select>
                @error('jenis') 
                    <div class="invalid-feedback fw-bold">{{ $message }}</div> 
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('skema.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection