<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    // Dashboard Admin
    public function index()
    {
        $totalPeserta = Peserta::count();
        $totalSkema = Skema::count();
        return view('dashboard', compact('totalPeserta', 'totalSkema'));
    }

    // Dashboard User
    public function userIndex()
    {
        $peserta = Peserta::where('user_id', Auth::id())->with('skema')->first();
        return view('dashboard.user', compact('peserta'));
    }

    // Melihat Detail Data Peserta Milik Sendiri (Sesuai route /data-peserta)
    public function userPesertaDetail()
    {   
        $peserta = Peserta::where('user_id', Auth::id())->with('skema', 'user')->first();
        
        // Jika data peserta tidak ditemukan / sudah dihapus
        if (!$peserta) {
            return view('dashboard.peserta-detail', compact('peserta'));
        }

        return view('dashboard.peserta-detail', compact('peserta'));
    }
    // Menampilkan Form Edit Data Peserta Milik Sendiri (Sesuai route /data-peserta/edit)
   public function userPesertaEdit()
    {
        $peserta = Peserta::where('user_id', Auth::id())->with('user')->first();
        
        // Jika data tidak ada, kembalikan dengan pesan peringatan
        if (!$peserta) {
            return redirect()->route('user.peserta.detail')->with('error', 'Data peserta Anda sudah tidak tersedia atau telah dihapus oleh Administrator.');
        }

        $skemas = Skema::all();
        return view('dashboard.peserta-edit', compact('peserta', 'skemas'));
    }

    // Memproses Update Data Peserta & Akun Milik Sendiri// Memproses Update Data Peserta & Akun Milik Sendiri
    public function userPesertaUpdate(Request $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $peserta = Peserta::where('user_id', $userId)->first();

        $request->validate([
            'name'       => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email'      => 'required|email|max:255|unique:users,email,' . $userId,
            'password'   => 'nullable|string|min:6|confirmed',
            'skema_id'   => 'required|exists:skemas,id',
            'jk'         => 'required|in:L,P',
            'almt'       => 'required|string',
            'no_hp'      => ['required', 'string', 'regex:/^08[0-9]{8,11}$/'],
        ], [

            'name.regex'    => 'Nama peserta hanya boleh berisi huruf dan spasi.',
            'no_hp.regex'         => 'Nomor HP harus diawali dengan 08 dan berisi 10-13 digit angka.',
            'email.unique'       => 'Email ini sudah digunakan oleh akun lain.',
            'password.min'       => 'Password baru minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        // 1. Update data pada tabel users (Nama, Email, Password)
        $userData = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        // 2. Update data pada tabel pesertas
        $peserta->update([
            'skema_id'   => $request->skema_id,
            'nm_peserta' => $request->name,
            'jk'         => $request->jk,
            'almt'       => $request->almt,
            'no_hp'      => $request->no_hp,
        ]);

        return redirect()->route('user.peserta.detail')->with('success', 'Data profil dan akun berhasil diperbarui!');
    }
}
