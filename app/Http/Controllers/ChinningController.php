<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChinningController extends Controller
{
    // Menampilkan dashboard utama
    public function index()
    {
        // Contoh data dummy, bisa diambil dari database nanti
        $score = 85;
        $training_time = 45; // dalam menit
        $otot_kanan = 32;     // kekuatan dalam kg
        $otot_kiri = 28;      // kekuatan dalam kg
        $dominasi_otot = session('dominasi_otot', 'kanan');

        return view('chinup.chinning', compact(
            'score',
            'training_time',
            'otot_kanan',
            'otot_kiri',
            'dominasi_otot'
        ));
        
    }

    // Menyimpan pengaturan dominasi otot
    public function aturDominasi(Request $request)
    {
        $request->validate([
            'dominasi_otot' => 'required|in:kanan,kiri',
        ]);

        // Simpan ke session (atau bisa disimpan ke database jika dibutuhkan)
        session(['dominasi_otot' => $request->dominasi_otot]);

        return redirect()->route('chinning')->with('success', 'Dominasi otot berhasil diperbarui!');
    }
}
