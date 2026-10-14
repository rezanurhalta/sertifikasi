@extends('layouts.app')

@section('content')
    {{-- 
    
    Tampilan ini menyajikan data daftar skema sertifikasi dalam bentuk tabel responsif Bootstrap.
--}}
    <div class="card card-simple shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold text-dark">Data Skema Sertifikasi</h5>
            <a href="{{ route('skema.create') }}" class="btn btn-primary btn-sm px-3">+ Tambah Skema</a>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover table-simple align-middle">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="18%">Kode Skema</th>
                            <th>Nama Skema Sertifikasi</th>
                            <th>Jenis Skema</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- 
                        Menggunakan @forelse untuk melooping data skema. Jika data kosong, 
                        secara otomatis blok @empty akan dieksekusi tanpa pemicu error.
                    --}}
                        @forelse($skemas as $index => $s)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td><span class="badge bg-light text-dark">{{ $s->kd_skema }}</span></td>
                                <td class="fw-medium">{{ $s->nm_skema }}</td>
                                <td>{{ $s->jenis }}</td>
                                <td class="text-center">
                                    {{-- Tombol Detail / Lihat --}}
                                    <a href="{{ route('skema.show', $s->id) }}"
                                        class="btn btn-info btn-sm text-white me-1">Detail</a>

                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('skema.edit', $s->id) }}"
                                        class="btn btn-warning btn-sm text-dark me-1">Edit</a>

                                    {{-- Form Hapus dengan Konfirmasi SweetAlert2 Merah --}}
                                    <form id="delete-form-{{ $s->id }}" action="{{ route('skema.destroy', $s->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete({{ $s->id }})">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada data skema.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- SweetAlert2 Library & Konfirmasi Hapus --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Konfirmasi Hapus Berwarna Merah (Danger/Warning)
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data skema ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545', // Warna tombol konfirmasi hapus (Merah)
                cancelButtonColor: '#6c757d', // Warna tombol batal (Abu-abu)
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        // Notifikasi Sukses Edit (Kuning / Warning) jika ada session 'success'
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                iconColor: '#ffc107', // Warna Ikon Notifikasi (Kuning)
                confirmButtonColor: '#ffc107', // Warna Tombol Ok (Kuning)
                confirmButtonText: '<span style="color: #000;">OK</span>'
            });
        @endif
    </script>
@endsection
