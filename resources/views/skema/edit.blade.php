@extends('layouts.app')

@section('content')
{{-- 
    PENJELASAN UNTUK ASESOR:
    Form ini digunakan untuk memperbarui data Skema Sertifikasi.
    Kolom Jenis Skema menggunakan elemen <select> dengan opsi terstandar.
--}}
<div class="card shadow-sm border-0 col-md-8 mx-auto">
    <div class="card-header bg-warning text-dark">
        <h5 class="mb-0 fw-bold">Edit Skema Sertifikasi</h5>
    </div>
    <div class="card-body p-4">

        <form action="{{ route('skema.update', $skema->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Input Kode Skema --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Kode Skema</label>
                <input type="text" name="kd_skema" 
                       class="form-control @error('kd_skema') is-invalid @enderror" 
                       value="{{ old('kd_skema', $skema->kd_skema) }}" required>
                
                @error('kd_skema')
                    <div class="invalid-feedback fw-bold">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Input Nama Skema --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Skema</label>
                <input type="text" name="nm_skema" 
                       class="form-control @error('nm_skema') is-invalid @enderror" 
                       value="{{ old('nm_skema', $skema->nm_skema) }}" required>
                
                @error('nm_skema')
                    <div class="invalid-feedback fw-bold">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Dropdown Jenis Skema (Auto Selected dari DB / Old Input) --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Jenis Skema</label>
                <select name="jenis" class="form-select @error('jenis') is-invalid @enderror" required>
                    <option value="">-- Pilih Jenis Skema --</option>
                    <option value="KKNI" {{ old('jenis', $skema->jenis) == 'KKNI' ? 'selected' : '' }}>KKNI</option>
                    <option value="Klaster" {{ old('jenis', $skema->jenis) == 'Klaster' ? 'selected' : '' }}>Klaster</option>
                    <option value="Okupasi" {{ old('jenis', $skema->jenis) == 'Okupasi' ? 'selected' : '' }}>Okupasi</option>
                    <option value="Unit Kompetensi" {{ old('jenis', $skema->jenis) == 'Unit Kompetensi' ? 'selected' : '' }}>Unit Kompetensi</option>
                </select>
                
                @error('jenis')
                    <div class="invalid-feedback fw-bold">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <button type="submit" class="btn btn-warning fw-semibold">Update</button>
            <a href="{{ route('skema.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection