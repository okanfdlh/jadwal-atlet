@extends('layouts.app')

@section('title', 'Edit Jadwal ' . ucfirst($jadwal->type))
@section('header', 'Edit Jadwal ' . ucfirst($jadwal->type))
@section('subheader', 'Perbarui informasi jadwal yang telah ditetapkan')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <form action="{{ route('admin.updateJadwal', $jadwal->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Nama</label>
            <input type="text" name="name" value="{{ old('name', $jadwal->name) }}"
                   class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Tanggal</label>
            <input type="date" name="day" value="{{ old('day', $jadwal->day) }}"
                   class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Waktu</label>
            <input type="time" name="time" value="{{ old('time', \Carbon\Carbon::parse($jadwal->time)->format('H:i')) }}"
                   class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
