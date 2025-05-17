<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:pengawas,atlet',
            'name' => 'required|string',
            'day' => 'required|date',
            'time' => 'required',
        ]);

        Schedule::create([
            'type' => $request->type,
            'name' => $request->name,
            'day' => $request->day,
            'time' => $request->time,
        ]);

        return back()->with('success', 'Jadwal berhasil disimpan.');
    }
    
}

