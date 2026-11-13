<?php

//nentuin alamat/lokasi class ini
namespace App\Http\Controllers;

// panggil fitur bawaan laravel yaitu request biar bisa nangkap semua data dari user seperti input form
use Illuminate\Http\Request;

//  ngehubungin models ke controller
use App\Models\PerawatanArmada;


class PerawatanArmadaController extends Controller
{
    // 1. CREATE data Logic
    public function store(Request $request)
    {
        // Menyimpan data langsung dari request form
        PerawatanArmada::create([ //fitur orm yang otomatis translate array php ke sql
            'nomor_seri' => $request->nomor_seri, //nangkap nilai dari input form yang punya atribut name='nomor_seri'
            'tanggal_perawatan' => $request->tanggal_perawatan,
        ]);

        // Mengembalikan halaman (refresh) dengan pesan sukses
        return redirect()->back()->with('success', 'Data perawatan berhasil disimpan!'); //balik ke page sebelumnya karena tiap crud ada modal yang muncul
    }

    // 2. UPDATE data Logic
    public function update(Request $request, $id) //request buat data baru, id itu data mana yang mau diubah
    {
        // Cari data berdasarkan ID, lalu update
        $perawatan = PerawatanArmada::findOrFail($id);
        
        $perawatan->update([
            'nomor_seri' => $request->nomor_seri,
            'tanggal_perawatan' => $request->tanggal_perawatan,
        ]);

        return redirect()->back()->with('success', 'Data perawatan berhasil diperbarui!');
    }

    // 3. DELETE data Logic
    public function destroy($id)
    {
        // Hapus data berdasarkan ID
        PerawatanArmada::destroy($id);

        return redirect()->back()->with('success', 'Data perawatan berhasil dihapus!');
    }


    //handle read and search database
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        
        // Logika query dengan pencarian
        if ($keyword) {
            $perawatan = PerawatanArmada::where('nomor_seri', 'like', '%' . $keyword . '%')
                            ->orderBy('tanggal_perawatan', 'desc')
                            ->get();
        } else {
            $perawatan = PerawatanArmada::orderBy('tanggal_perawatan', 'desc')->get();
        }

        return view('perawatan', compact('perawatan', 'keyword'));
    }
}