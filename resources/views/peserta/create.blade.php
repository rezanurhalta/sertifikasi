@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0 col-md-8 mx-auto">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Tambah Data Peserta</h5>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('peserta.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Skema Sertifikasi</label>
                <select name="skema_id" class="form-select @error('skema_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Skema --</option>
                    @foreach($skemas as $s)
                        <option value="{{ $s->id }}" {{ old('skema_id') == $s->id ? 'selected' : '' }}>
                            {{ $s->kd_skema }} - {{ $s->nm_skema }}
                        </option>
                    @endforeach
                </select>
                @error('skema_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Peserta</label>
                <input type="text" name="nm_peserta" class="form-control @error('nm_peserta') is-invalid @enderror" value="{{ old('nm_peserta') }}" required>
                @error('nm_peserta') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jk" class="form-select" required>
                    <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="P" {{ old('jk') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">No. Telepon / HP</label>
                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" required>
                @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="almt" class="form-control @error('almt') is-invalid @enderror" rows="3" required>{{ old('almt') }}</textarea>
                @error('almt') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan Peserta</button>
            <a href="{{ route('peserta.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection