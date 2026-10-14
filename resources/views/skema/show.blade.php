@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <!-- Tombol Kembali -->
            <div class="mb-3">
                <a href="{{ route('skema.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Skema
                </a>
            </div>

            <!-- Card Utama Detail Skema -->
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center py-3 rounded-top-4">
                    <h3 class="fw-bold mb-0 text-uppercase">{{ $skema->nm_skema }}</h3>
                    <small class="text-light">Detail Informasi Skema Sertifikasi LSP</small>
                </div>
                
                <div class="card-body p-4">
                    
                    <!-- Tabel Informasi Skema (Tanpa Jumlah Unit) -->
                    <table class="table table-bordered align-middle">
                        <tr>
                            <th width="25%" class="bg-light">Kode Skema</th>
                            <td>: <span class="badge bg-secondary">{{ $skema->kd_skema }}</span></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Nama Skema</th>
                            <td>: <strong>{{ $skema->nm_skema }}</strong></td>
                        </tr>
                        <tr>
                            <th class="bg-light">Jenis Skema</th>
                            <td>: {{ $skema->jenis ?? 'Klaster / Okupasi' }}</td>
                        </tr>
                    
                        <tr>
                            <th class="bg-light">Ringkasan Skema</th>
                            <td>: Melakukan aktivitas sertifikasi kompetensi profesi untuk bidang {{ $skema->nm_skema }} sesuai standar SKKNI yang berlaku.</td>
                        </tr>
                    </table>

                    <!-- Tab Persyaratan Saja (Bagian Unit Kompetensi Dihapus) -->
                    <div class="mt-4">
                        <h5 class="fw-bold mb-3">Persyaratan Dasar Pemohon Sertifikasi</h5>
                        <ul class="list-group list-group-numbered">
                            <li class="list-group-item border-0">Siswa/i SMK jurusan terkait atau mahasiswa bidang teknologi/pemasaran.</li>
                            <li class="list-group-item border-0">Memiliki portofolio atau pernah mengerjakan proyek yang relevan.</li>
                            <li class="list-group-item border-0">Melampirkan scan Kartu Identitas (KTP/Kartu Pelajar) dan pas foto terbaru.</li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection