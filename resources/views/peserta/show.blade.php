@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0 col-md-8 mx-auto">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Detail Data Peserta</h5>
    </div>
    <div class="card-body p-4">
        <table class="table table-borderless">
            <tr>
                <th width="30%">Nama Peserta</th>
                <td>: {{ $peserta->nm_peserta }}</td>
            </tr>
            {{-- Tambahan Baris Email Akun --}}
            <tr>
                <th>Email Akun</th>
                <td>: {{ $peserta->user->email ?? 'Tidak ada akun (Ditambahkan Admin)' }}</td>
            </tr>
            <tr>
                <th>Skema Sertifikasi</th>
                <td>: {{ $peserta->skema?->nm_skema ?? 'Skema Tidak Ditemukan' }} ({{ $peserta->skema?->kd_skema ?? '-' }})</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>: {{ $peserta->jk == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <th>No. Telepon / HP</th>
                <td>: {{ $peserta->no_hp }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>: {{ $peserta->almt }}</td>
            </tr>
        </table>
        <a href="{{ route('peserta.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection