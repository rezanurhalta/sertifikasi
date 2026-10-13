<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use Illuminate\Http\Request;

class SkemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skemas = Skema::latest()->get();
        return view('skema.index', compact('skemas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('skema.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kd_skema' => 'required|unique:skemas,kd_skema',
            'nm_skema' => 'required',
          'jenis'    => 'required|in:KKNI,Klaster,Okupasi,Unit Kompetensi',
        ], [
            'kd_skema.unique' => 'Kode skema ini sudah terdaftar. Gunakan kode yang lain!',
        'kd_skema.required' => 'Kolom kode skema wajib diisi.',
        'jenis.in' => 'Jenis skema yang dipilih tidak valid.'
        ]);
        Skema::create($request->all());
        return redirect()->route('skema.index')->with('success', 'Skema berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $skema = Skema::findOrFail($id);
        return view('skema.show', compact('skema'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // DIPERBAIKI: Cari data skema berdasarkan $id
        $skema = Skema::findOrFail($id);
        return view('skema.edit', compact('skema'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $skema = Skema::findOrFail($id);

        $request->validate([
            'kd_skema' => 'required|unique:skemas,kd_skema,' . $skema->id,
            'nm_skema' => 'required',   
          'jenis'    => 'required|in:KKNI,Klaster,Okupasi,Unit Kompetensi',
        ], [
            'kd_skema.unique' => 'Kode skema ini sudah digunakan oleh data lain!',
            'jenis.in' => 'Jenis skema yang dipilih tidak valid.'
        ]);

        $skema->update($request->all());
        return redirect()->route('skema.index')->with('success', 'Skema berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) 
    {
        $skema = Skema::findOrFail($id);
        $skema->delete();
        return redirect()->route('skema.index')->with('success', 'Skema berhasil dihapus');
    }
}