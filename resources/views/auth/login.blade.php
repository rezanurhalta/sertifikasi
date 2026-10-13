@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
            <div class="col-md-5 col-lg-4">

                {{-- Card Box Sederhana --}}
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                    <div class="card-body">

                        {{-- Judul / Header Sederhana --}}
                        <div class="text-center mb-4">
                            <h4 class="fw-bold text-dark mb-1">Login Admin</h4>
                            <p class="text-muted small">Silakan masuk untuk mengelola data sistem</p>
                        </div>

                        {{-- Pesan Error Validasi / Gagal Login --}}
                        @if ($errors->any())
                            <div class="alert alert-danger py-2 small text-center mb-3">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        {{-- Form Login --}}
                        <form action="{{ route('login') }}" method="POST" autocomplete="off">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label text-secondary small fw-bold">EMAIL</label>
                                <input type="email" name="email" class="form-control form-control-lg fs-6"
                                    placeholder="masukkan email" required autocomplete="off">
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-secondary small fw-bold">PASSWORD</label>
                                <input type="password" name="password" class="form-control form-control-lg fs-6"
                                    placeholder="masukkan password" required autocomplete="new-password">
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold shadow-sm">
                                Masuk
                            </button>
                        </form>

                    </div>
                </div>

                {{-- Tautan Kembali ke Beranda --}}
                <div class="text-center mt-3">
                    <a href="{{ route('welcome') }}" class="text-decoration-none text-muted small">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
