@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Edit Data Diri & Akun</h5>
                </div>
                <div class="card-body p-4">
                    
                    {{-- Pesan Error Validasi --}}
                    @if($errors->any())
                        <div class="alert alert-danger py-2 small mb-3">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('user.peserta.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <h6 class="text-primary fw-bold mb-3">Informasi Akun</h6>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $peserta->user->name ?? $peserta->nm_peserta) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $peserta->user->email ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru <span class="text-muted small">(Kosongkan jika tidak ingin mengubah password)</span></label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password baru...">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru...">
                        </div>

                        <hr class="my-4">
                        <h6 class="text-primary fw-bold mb-3">Informasi Sertifikasi & Kontak</h6>

                        <div class="mb-3">
                            <label class="form-label">Skema Sertifikasi</label>
                            <select name="skema_id" class="form-select" required>
                                @foreach($skemas as $s)
                                    <option value="{{ $s->id }}" {{ old('skema_id', $peserta->skema_id) == $s->id ? 'selected' : '' }}>
                                        [{{ $s->kd_skema }}] {{ $s->nm_skema }}
                                    </option>
                                @endforeach
                            </select>
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

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('user.peserta.detail') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection