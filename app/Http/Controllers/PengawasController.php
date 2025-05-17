<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengawasController extends Controller
{
    public function index()
    {
        return view('pengawas.dashboard');
    }   
    public function showJenisLatihan()
    {
        return view('pengawas.jenis-latihan');
    }

    // Tampilkan form input parameter sesuai jenis latihan yg dipilih
    public function showInputParameter(Request $request)
    {
        $jenis = $request->query('jenis');

        if (!in_array($jenis, ['chinning', 'pullup'])) {
            return redirect()->route('pengawas.jenisLatihan')->withErrors('Jenis latihan tidak valid.');
        }

        return view('pengawas.input-parameter', compact('jenis'));
    }
    public function analyze(Request $request)
    {
        $umur = $request->umur;
        $berat = $request->berat;
        $tinggi = $request->tinggi;
        $jenis_kelamin = $request->jenis_kelamin;

        // Hitung kebutuhan kalori BMR (Basal Metabolic Rate)
        $bmr = $jenis_kelamin == 'L'
            ? 66 + (13.7 * $berat) + (5 * $tinggi) - (6.8 * $umur)
            : 655 + (9.6 * $berat) + (1.8 * $tinggi) - (4.7 * $umur);

        $hasil = [
            'kalori' => round($bmr),
            'karbo' => round(0.6 * $bmr / 4),   // 60% kalori dari karbo
            'protein' => round(0.2 * $bmr / 4), // 20% kalori dari protein
            'lemak' => round(0.2 * $bmr / 9),   // 20% kalori dari lemak
            'kategori_otot' => $berat / pow($tinggi / 100, 2) > 25 ? 'Kuat' : 'Perlu Latihan',
            'saran' => $berat / pow($tinggi / 100, 2) > 25 
                ? 'Pertahankan kekuatan otot dengan latihan rutin.' 
                : 'Tingkatkan latihan kekuatan otot & konsumsi protein.'
        ];

        return redirect()->route('pengawas.index')->with('hasil', $hasil);
    }
}   //

