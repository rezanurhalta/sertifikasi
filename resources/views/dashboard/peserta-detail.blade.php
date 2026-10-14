@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Data Diri Peserta</h5>
                    <a href="{{ route('user.peserta.edit') }}" class="btn btn-warning btn-sm text-dark fw-bold">Edit Data</a>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($peserta)
                        <!-- Tambahan Kotak Status Asesmen dari Admin -->
                        <div class="mb-4 text-center p-3 bg-light rounded border">
                            <h6 class="text-muted mb-2">Status Hasil Asesmen Ujian:</h6>
                            <div>
                                @if($peserta->status == 'Kompeten')
                                    <span class="badge bg-success fs-5 px-4 py-2">Kompeten (Lulus)</span>
                                @elseif($peserta->status == 'Belum Kompeten')
                                    <span class="badge bg-danger fs-5 px-4 py-2">Belum Kompeten</span>
                                @else
                                    <span class="badge bg-warning text-dark fs-5 px-4 py-2">Menunggu Penilaian</span>
                                @endif
                            </div>
                        </div>

                        <table class="table table-bordered">
                            <tr>
                                <th>Nama Lengkap</th>
                                <td>{{ $peserta->nm_peserta }}</td>
                            </tr>
                            <tr>
                                <th>Skema Sertifikasi</th>
                                <td>
                                    @if($peserta->skema)
                                        <span class="badge bg-secondary">[{{ $peserta->skema->kd_skema }}]</span> 
                                        {{ $peserta->skema->nm_skema }} 
                                        ({{ $peserta->skema->jenis ?? '-' }})
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $peserta->jk == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Telepon / HP</th>
                                <td>{{ $peserta->no_hp }}</td>
                            </tr>
                            <tr>
                                <th>Alamat Lengkap</th>
                                <td>{{ $peserta->almt }}</td>
                            </tr>
                        </table>
                    @else
                        <!-- Peringatan jika data peserta dihapus / tidak ditemukan oleh admin -->
                        <div class="alert alert-danger text-center p-4">
                            <h5 class="alert-heading fw-bold">Peringatan Akses</h5>
                            <p class="mb-3">Data peserta atau akun Anda sudah tidak ada atau telah dihapus oleh Administrator.</p>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-dark btn-sm">Keluar Sistem</a>
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