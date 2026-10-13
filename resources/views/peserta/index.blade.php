@extends('layouts.app')

@section('content')
    <div class="card card-simple shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold text-dark">Data Peserta Sertifikasi</h5>
            {{-- <a href="{{ route('peserta.create') }}" class="btn btn-primary btn-sm px-3">+ Tambah Peserta</a> --}}
        </div>
        <div class="card-body p-4">

            <!-- Form Pencarian -->
            <form action="{{ route('peserta.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                        placeholder="Cari berdasarkan nama peserta atau skema..." value="{{ $search ?? '' }}">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    @if (!empty($search))
                        <a href="{{ route('peserta.index') }}" class="btn btn-outline-danger">Reset</a>
                    @endif
                </div>
            </form>

            <!-- Tabel Data Peserta -->
            <div class="table-responsive">
                <table class="table table-hover table-simple align-middle">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th>Nama Peserta</th>
                            <th>Email Akun</th>
                            <th>Skema Sertifikasi</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">L/P</th>
                            <th>No. HP</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesertas as $index => $p)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $p->nm_peserta }}</td>
                                <td>
                                    {{-- Memanggil email dari relasi user --}}
                                    {{ $p->user->email ?? 'Tidak ada akun' }}
                                </td>
                                <td>
                                    @if ($p->skema)
                                        <span class="badge badge-code text-dark">{{ $p->skema->kd_skema }}</span>
                                        <span>{{ $p->skema->nm_skema }}</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak ada skema</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{-- Badge Warna Berdasarkan Status --}}
                                    @if($p->status == 'Kompeten')
                                        <span class="badge bg-success">Kompeten</span>
                                    @elseif($p->status == 'Belum Kompeten')
                                        <span class="badge bg-danger">Belum Kompeten</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $p->jk }}</td>
                                <td>{{ $p->no_hp }}</td>
                                <td class="text-center">
                                    <a href="{{ route('peserta.show', $p->id) }}"
                                        class="btn btn-info btn-sm text-white">Detail</a>
                                    <a href="{{ route('peserta.edit', $p->id) }}"
                                        class="btn btn-warning btn-sm text-dark">Edit</a>

                                    <form action="{{ route('peserta.destroy', $p->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data peserta ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">Data peserta tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // SweetAlert Konfirmasi Hapus Data (Merah)
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data peserta ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545', // Tombol konfirmasi hapus (Merah Danger)
                cancelButtonColor: '#6c757d', // Tombol Batal (Abu-abu)
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        // Notifikasi Berhasil (Simpan / Edit / Hapus) Berwarna Akses Kuning
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                iconColor: '#ffc107', // Warna Ikon (Kuning)
                confirmButtonColor: '#ffc107', // Warna Tombol Ok (Kuning)
                confirmButtonText: '<span style="color: #000;">OK</span>'
            });
        @endif
    </script>
@endsection