@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-6 col-lg-5">
            
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="card-body">
                    
                    <div class="text-center mb-4">
                        <h4 class="fw-bold text-dark mb-1">Daftar Akun Peserta</h4>
                        <p class="text-muted small">Lengkapi data diri dan pilih skema sertifikasi Anda</p>
                    </div>

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

                    {{-- Form Register --}}
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">NAMA LENGKAP</label>
                            <input type="text" name="name" class="form-control form-control-lg fs-6" placeholder="Nama Anda" required value="{{ old('name') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">EMAIL (@gmail.com)</label>
                            <input type="email" name="email" class="form-control form-control-lg fs-6" placeholder="contoh@gmail.com" required value="{{ old('email') }}">
                        </div>

                        {{-- Pilihan Skema Sertifikasi --}}
                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">PILIH SKEMA SERTIFIKASI</label>
                            <select name="skema_id" class="form-control form-control-lg fs-6" required>
                                <option value="">-- Pilih Skema --</option>
                                @foreach($skemas as $s)
                                    <option value="{{ $s->id }}" {{ old('skema_id') == $s->id ? 'selected' : '' }}>
                                        [{{ $s->kd_skema }}] {{ $s->nm_skema }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">JENIS KELAMIN</label>
                            <select name="jk" class="form-control form-control-lg fs-6" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jk') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        {{-- Nomor HP --}}
                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">NOMOR HP</label>
                            <input type="text" name="no_hp" class="form-control form-control-lg fs-6" placeholder="Contoh: 081234567890" required value="{{ old('no_hp') }}">
                        </div>

                        {{-- Alamat --}}
                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">ALAMAT LENGKAP</label>
                            <textarea name="almt" class="form-control fs-6" rows="3" placeholder="Alamat tempat tinggal Anda" required>{{ old('almt') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">PASSWORD</label>
                            <input type="password" name="password" class="form-control form-control-lg fs-6" placeholder="Buat Password (min. 6 karakter)" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-secondary small fw-bold">KONFIRMASI PASSWORD</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg fs-6" placeholder="Ulangi password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold shadow-sm">
                            Daftar Sekarang
                        </button>
                    </form>

                </div>
            </div>

            <div class="text-center mt-3">
                <span class="text-muted small">Sudah punya akun?</span> 
                <a href="{{ route('login') }}" class="text-decoration-none fw-semibold small">Login di sini</a>
            </div>

        </div>
    </div>
</div>
@endsection