<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
    public function daftar()
    {
    
        $rak = Rak::orderByDesc('Kode_Rak')->get();

        return view('rak.index', compact('rak'));
    }

    public function create()
    {
        return view('rak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Kode_Rak'  => 'required|unique:rak,Kode_Rak',
            'Zona'      => 'required',
            'Lorong'    => 'required',
            'Level'     => 'required|integer',
            'kapasitas' => 'required|integer',
            'isi_rak'   => 'required',
        ]);

        Rak::create([
            'Kode_Rak'  => $request->Kode_Rak,
            'Zona'      => $request->Zona,
            'Lorong'    => $request->Lorong,
            'Level'     => $request->Level,
            'kapasitas' => $request->kapasitas,
            'isi_rak'   => $request->isi_rak,
        ]);

        return redirect()->route('rak.index')->with('success', 'Data rak berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $rak = Rak::findOrFail($id);
        return view('rak.edit', compact('rak'));
    }

    public function update(Request $request, $id)
    {
        $rak = Rak::findOrFail($id);

        $request->validate([
            'Kode_Rak'  => 'required',
            'Zona'      => 'required',
            'Lorong'    => 'required',
            'Level'     => 'required|integer',
            'kapasitas' => 'required|integer',
            'isi_rak'   => 'required',
        ]);

        $rak->update([
            'Kode_Rak'  => $request->Kode_Rak,
            'Zona'      => $request->Zona,
            'Lorong'    => $request->Lorong,
            'Level'     => $request->Level,
            'kapasitas' => $request->kapasitas,
            'isi_rak'   => $request->isi_rak,
        ]);

        return redirect()->route('rak.index')->with('success', 'Data rak berhasil diperbarui!');
    }

    
    public function destroy($id)
    {
        $rak = Rak::findOrFail($id);
        $rak->delete();

        return redirect()->route('rak.index')->with('success', 'Data rak berhasil dihapus!');
    }
}