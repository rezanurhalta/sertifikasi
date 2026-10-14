@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 text-center">
                    
                    {{-- Cek apakah data peserta masih tersedia atau sudah dihapus admin --}}
                    @php
                        $peserta = \App\Models\Peserta::where('user_id', Auth::id())->first();
                    @endphp

                    @if($peserta)
                        
                        <h3 class="fw-bold mb-3">Selamat Datang, {{ Auth::user()->name }}!</h3>
                        <p class="text-muted">Anda berhasil login sebagai  User.</p>

                        {{-- <div class="my-3">
                            <span class="badge 
                                @if($peserta->status == 'Kompeten') bg-success 
                                @elseif($peserta->status == 'Belum Kompeten') bg-danger 
                                @else bg-warning text-dark @endif fs-6 px-3 py-2">
                                Status Asesmen: {{ $peserta->status }}
                            </span>
                        </div> --}}

                        <hr class="my-4">

                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('user.peserta.detail') }}" class="btn btn-primary px-4">Lihat Data Diri</a>
                            <a href="{{ route('user.peserta.edit') }}" class="btn btn-warning px-4">Edit Data Diri</a>
                        </div>
                    @else
                        
                        <div class="alert alert-danger m-0 p-4 text-start border-0 shadow-sm">
                            <h4 class="alert-heading fw-bold text-danger mb-3">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> Akses Dibatasi
                            </h4>
                            <p class="mb-3 text-dark">Mohon maaf, data peserta atau akun Anda sudah tidak tersedia di sistem atau telah dihapus oleh Administrator LSP.</p>
                            <hr>
                            <p class="small text-muted mb-4">Silakan hubungi admin terkait atau klik tombol di bawah untuk keluar dari sistem.</p>
                            <div class="text-center">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-dark px-4 py-2">Keluar Sistem</a>
                            </div>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection