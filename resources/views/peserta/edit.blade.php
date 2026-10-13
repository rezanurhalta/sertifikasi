@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0 col-md-8 mx-auto">
    <div class="card-header bg-warning text-dark">
        <h5 class="mb-0">Edit Data Peserta</h5>
    </div>
    <div class="card-body p-4">
      <form action="{{ route('peserta.update', $peserta->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label">Skema Sertifikasi</label>
                <select name="skema_id" class="form-select" required>
                    @foreach($skemas as $s)
                        <option value="{{ $s->id }}" {{ old('skema_id', $peserta->skema_id) == $s->id ? 'selected' : '' }}>
                            {{ $s->kd_skema }} - {{ $s->nm_skema }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Peserta</label>
                <input type="text" name="nm_peserta" class="form-control" value="{{ old('nm_peserta', $peserta->nm_peserta) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jk" class="form-select" required>
                    <option value="L" {{ old('jk', $peserta->jk) == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="P" {{ old('jk', $peserta->jk) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">No. Telepon / HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $peserta->no_hp) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="almt" class="form-control" rows="3" required>{{ old('almt', $peserta->almt) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold text-dark">Status Kompetensi</label>
                <select name="status" class="form-select" required>
                    <option value="Menunggu" {{ old('status', $peserta->status) == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="Kompeten" {{ old('status', $peserta->status) == 'Kompeten' ? 'selected' : '' }}>Kompeten (Lulus)</option>
                    <option value="Belum Kompeten" {{ old('status', $peserta->status) == 'Belum Kompeten' ? 'selected' : '' }}>Belum Kompeten</option>
                </select>
            </div>

            <button type="submit" class="btn btn-warning">Update Data</button>
            <a href="{{ route('peserta.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection