<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Peserta; // Tambahkan Model Peserta
use App\Models\Skema;   // Tambahkan Model Skema
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   public function showlogin(){
    return view('auth.login');
   }

   public function login(Request $request)
   {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    
    if (Auth::attempt($credentials)){
        $request->session()->regenerate();
        session()->forget('url.intended');

        if (Auth::user()->role === 'admin') {
            return redirect()->to('/dashboard');
        } else {
            return redirect()->to('/dashboard-user');
        }
    }
    return back()->withErrors(['email'=>'Email atau password salah!']);
   }

   public function logout(Request $request)
   {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
   }

   // Menampilkan form register dengan membawa data skema
   public function showRegister()
   {
       $skemas = Skema::all(); // Ambil data skema dari database
       return view('auth.register', compact('skemas'));
   }

   // Memproses data pendaftaran akun baru & otomatis simpan ke tabel pesertas
   public function register(Request $request)
   {
        // 1. Validasi input form (akun + data peserta)
       $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/^[\w\.-]+@gmail\.com$/i' 
            ],
            'password' => 'required|string|min:6|confirmed',
            // Validasi tambahan untuk tabel pesertas
            'skema_id' => 'required|exists:skemas,id',
            'jk'       => 'required|in:L,P',
            'no_hp'    => 'required|string|max:15',
            'almt'     => 'required|string',
        ], [
            'email.unique'       => 'Email ini sudah terdaftar. Gunakan email lain!',
            'email.regex'        => 'Email wajib menggunakan @gmail.com!', 
            'password.min'       => 'Password minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'skema_id.required'  => 'Silakan pilih skema sertifikasi.',
            'jk.required'        => 'Jenis kelamin wajib dipilih.',
            'no_hp.required'     => 'Nomor HP wajib diisi.',
            'almt.required'      => 'Alamat wajib diisi.',
        ]);

        // 2. Simpan data user baru ke tabel users
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user', 
        ]);

        // 3. Simpan data ke tabel pesertas secara otomatis dan terelasi
        Peserta::create([
            'user_id'    => $user->id, // Mengambil ID dari user yang baru saja dibuat
            'skema_id'   => $request->skema_id,
            'nm_peserta' => $request->name,
            'jk'         => $request->jk,
            'almt'       => $request->almt,
            'no_hp'      => $request->no_hp,
        ]);

        // 4. Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Akun dan data peserta berhasil dibuat! Silakan login.');
   }
}