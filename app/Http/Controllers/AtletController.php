<?php

namespace App\Http\Controllers;

use App\Models\HasilLatihan;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AtletController extends Controller
{
    public function index()
{
    $user = Auth::user();

    // Ambil jadwal latihan milik atlet
    $jadwal = Schedule::where('atlet_id', $user->id)->get();

    // Ambil hasil latihan berdasarkan relasi ke schedule
    $monitoring = HasilLatihan::whereHas('schedule', function ($query) use ($user) {
        $query->where('atlet_id', $user->id);
    })->latest()->get();

    return view('atlet.dashboard', compact('jadwal', 'monitoring'));
}
}
