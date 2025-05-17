<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PullUpController extends Controller
{
    // Menampilkan halaman monitoring pull-up
    public function index()
    {
        // Data dummy - nanti bisa diganti dari database
        $score = 90;
        $training_time = 50; // menit
        $otot_kanan = 35; // kg
        $otot_kiri = 30;  // kg
        $dominasi_otot = session('dominasi_otot', 'kanan'); // default kanan

        return view('pullup.pullup', compact(
            'score',
            'training_time',
            'otot_kanan',
            'otot_kiri',
            'dominasi_otot'
        ));
    }

    // Menyimpan dominasi otot (POST)
    public function aturDominasi(Request $request)
    {
        $request->validate([
            'dominasi_otot' => 'required|in:kanan,kiri',
        ]);

        session(['dominasi_otot' => $request->dominasi_otot]);

        return redirect()->route('pullup.index')->with('success', 'Dominasi otot berhasil diperbarui!');
    }
}
