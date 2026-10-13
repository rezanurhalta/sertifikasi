@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card shadow-sm border-0 bg-white p-4">
            <h3 class="fw-bold text-primary">Selamat Datang, {{ Auth::user()->name }}!</h3>
            <p class="text-muted mb-0">Sistem Informasi Pengelolaan Data Peserta Sertifikasi LSP (Junior Web Developer)</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0 bg-primary text-white">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase fw-semibold mb-1">Total Skema Sertifikasi</h6>
                    <h2 class="display-5 fw-bold mb-0">{{ $totalSkema }}</h2>
                </div>
                <div>
                    <a href="{{ route('skema.index') }}" class="btn btn-light btn-sm text-primary fw-bold">Kelola Skema &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0 bg-success text-white">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase fw-semibold mb-1">Total Peserta Terdaftar</h6>
                    <h2 class="display-5 fw-bold mb-0">{{ $totalPeserta }}</h2>
                </div>
                <div>
                    <a href="{{ route('peserta.index') }}" class="btn btn-light btn-sm text-success fw-bold">Kelola Peserta &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection