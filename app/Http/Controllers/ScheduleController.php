<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pengawas_id' => 'required|exists:users,id',
            'atlet_id' => 'required|exists:users,id',
            'day' => 'required|date',
            'time' => 'required',
            'type' => 'required|string',
        ]);

        Schedule::create([
            'pengawas_id' => $validated['pengawas_id'],
            'atlet_id' => $validated['atlet_id'],
            'day' => $validated['day'],
            'time' => $validated['time'],
            'type' => $validated['type'],
        ]);

        return back()->with('success', 'Jadwal berhasil disimpan.');
    }


    public function create()
    {
        $pengawas = User::where('role', 'pengawas')->get();
        $atlet = User::where('role', 'atlet')->get();

        return view('admin.create-jadwal', compact('pengawas', 'atlet'));
    }

    public function jadwalGabungan(Request $request)
    {
        $query = Schedule::with(['pengawas', 'atlet']);

        // Filter berdasarkan nama pengawas
        if ($request->filled('search')) {
            $query->whereHas('pengawas', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan tanggal
        if ($request->filled('date')) {
            $query->whereDate('day', $request->date);
        }

        // Ubah urutan menjadi dari terbaru ke terlama
        $jadwals = $query
            ->orderBy('day', 'desc')   // tanggal terbaru
            ->orderBy('time', 'desc')  // jam terbaru
            ->paginate(10);

        $jadwals->appends($request->all()); // menjaga query filter saat pagination

        return view('admin.jadwal-gabungan', compact('jadwals'));
    }

}

