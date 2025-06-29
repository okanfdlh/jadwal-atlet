<?php

namespace App\Http\Controllers;

use App\Models\HasilLatihan;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AtletController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $tanggal = $request->get('tanggal') ?? Carbon::today()->toDateString();

        // Ambil jadwal latihan (jika kamu ingin dari tanggal "day" juga)
        $jadwal = Schedule::where('atlet_id', $user->id)
            ->whereDate('day', $tanggal)
            ->get();

        // Ambil data monitoring berdasarkan kolom 'day', bukan 'created_at'
        $monitoring = HasilLatihan::whereHas('schedule', function ($query) use ($user, $tanggal) {
                $query->where('atlet_id', $user->id)
                    ->whereDate('day', $tanggal);
            })
            ->orderBy('created_at')
            ->get();

        $labels = $monitoring->pluck('schedule.day')->map(fn($d) => Carbon::parse($d)->format('d M'))->toArray();


        // Data untuk grafik
        $labels = $monitoring->pluck('day')->map(fn($d) => Carbon::parse($d)->format('d M'))->toArray();

        $skorData = $monitoring->map(fn($m) => match ($m->skor) {
            'Sempurna' => 100,
            'Baik Sekali' => 80,
            'Baik' => 60,
            'Cukup' => 40,
            'Kurang' => 20,
            'Sangat Kurang' => 10,
            default => 0,
        })->toArray();

        $beratData = $monitoring->pluck('berat')->toArray();
        $repData = $monitoring->pluck('repitisi')->toArray();

        return view('atlet.dashboard', compact(
            'jadwal', 'monitoring',
            'labels', 'skorData', 'beratData', 'repData'
        ));
    }

}
