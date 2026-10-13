@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 text-center">
                    <h3 class="fw-bold mb-3">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-muted">Anda berhasil login sebagai Peserta / User.</p>

                    <hr class="my-4">

                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('user.peserta.detail') }}" class="btn btn-primary px-4">Lihat Data Diri</a>
                        <a href="{{ route('user.peserta.edit') }}" class="btn btn-warning px-4">Edit Data Diri</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection