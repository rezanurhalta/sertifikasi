<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $pesertas = Peserta::with('skema')
            ->when($search, function ($query, $search) {
                return $query->where('nm_peserta', 'like', "%{$search}%")
                             ->orWhereHas('skema', function ($q) use ($search) {
                                 $q->where('nm_skema', 'like', "%{$search}%");
                             });
            })
            ->latest()->get();

        return view('peserta.index', compact('pesertas', 'search'));
    }

    public function create()
    {
        $skemas = Skema::all();
        return view('peserta.create', compact('skemas'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //        'skema_id'   => 'required|exists:skemas,id',
    //     'nm_peserta' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'], 
    //     'jk'         => 'required|in:L,P',
    //     'almt'       => 'required|string',
    //     'no_hp'      => 'required|string|max:15',
    // ], [
    //     'nm_peserta.regex' => 'Nama peserta hanya boleh berisi huruf dan spasi.', 
    //     'nm_peserta.required' => 'Nama peserta wajib diisi.',
    // ]);
    //     Peserta::create($request->all());
    //     return redirect()->route('peserta.index')->with('success', 'Peserta berhasil ditambahkan');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'skema_id'   => 'required|exists:skemas,id',
            'nm_peserta' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'], 
            'jk'         => 'required|in:L,P',
            'almt'       => 'required|string',
            'no_hp'      => 'required|string|max:15',
        ], [
            'nm_peserta.regex'    => 'Nama peserta hanya boleh berisi huruf dan spasi.', 
            'nm_peserta.required' => 'Nama peserta wajib diisi.',
        ]);

        // Gunakan create dengan memasukkan user_id secara eksplisit bernilai null
        Peserta::create([
            'user_id'    => null, // Karena ditambahkan oleh admin tanpa akun login mandiri
            'skema_id'   => $request->skema_id,
            'nm_peserta' => $request->nm_peserta,
            'jk'         => $request->jk,
            'almt'       => $request->almt,
            'no_hp'      => $request->no_hp,
        ]);

        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil ditambahkan');
    }

    // PENTING: Mengambil data peserta berdasarkan ID beserta relasi skema
    public function show($id)
    {
        $peserta = Peserta::with('skema')->findOrFail($id);
        return view('peserta.show', compact('peserta'));
    }

    // PENTING: Mengambil data peserta berdasarkan ID untuk diisi ke form edit
    public function edit($id)
    {
        $peserta = Peserta::findOrFail($id);
        $skemas = Skema::all();
        return view('peserta.edit', compact('peserta', 'skemas'));
    }

    // PENTING: Proses menyimpan perubahan data ke database
    public function update(Request $request, $id)
    {
        $request->validate([
            'skema_id'   => 'required',
            'nm_peserta' => 'required',
            'jk'         => 'required',
            'almt'       => 'required',
            'no_hp'      => 'required',
            'status'     => 'required|in:Menunggu,Kompeten,Belum Kompeten',
        ]);

        $peserta = Peserta::findOrFail($id);
        $peserta->update($request->all());

        return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil diperbarui');
    }

    public function destroy($id)
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->delete();
        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil dihapus');
    }
}