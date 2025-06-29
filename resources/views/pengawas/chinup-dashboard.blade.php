@extends('admin.layout')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow mt-6">
    <h2 class="text-2xl font-bold mb-4">Hasil Monitoring</h2>

    {{-- Skor dan Waktu --}}
    <div class="grid grid-cols-2 gap-6 mb-6">
        <div class="bg-gray-100 p-4 rounded shadow">
            <h3 class="text-xl font-semibold">Skor</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $score }} poin</p>
        </div>
        <div class="bg-gray-100 p-4 rounded shadow">
            <h3 class="text-xl font-semibold">Waktu Pelatihan</h3>
            <p class="text-3xl font-bold text-green-600">{{ $training_time }} menit</p>
            {{-- <p class="text-sm text-gray-600">Terakhir diperbarui: {{ $waktu }}</p> --}}
        </div>
    </div>

    {{-- Kekuatan Otot --}}
    <div class="bg-gray-100 p-6 rounded shadow mb-6">
        <h3 class="text-xl font-semibold mb-4">Kekuatan Otot</h3>
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block font-medium mb-1">Otot Kanan (kg)</label>
                <input type="number" value="{{ $otot_kanan }}" class="w-full p-2 border rounded" readonly>
            </div>
            <div>
                <label class="block font-medium mb-1">Otot Kiri (kg)</label>
                <input type="number" value="{{ $otot_kiri }}" class="w-full p-2 border rounded" readonly>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-6 mt-4">
        <div>
            <label class="block font-medium mb-1">Repetisi</label>
            <input type="number" value="{{ $repitisi }}" class="w-full p-2 border rounded" readonly>
        </div>
        <div>
            <label class="block font-medium mb-1">Dominasi Otot</label>
            <input type="text" value="{{ ucfirst($dominasi_otot) }}" class="w-full p-2 border rounded" readonly>
        </div>
    </div>
    {{-- <div class="grid grid-cols-2 gap-6 mt-4">
        <div>
            <label class="block font-medium mb-1">Skor</label>
            <input type="number" value="{{ $skor }}" class="w-full p-2 border rounded" readonly>
        </div>
    </div> --}}
</div>
    {{-- Tombol Lihat History --}}
    <div class="text-center mt-6">
        <a href="{{ route('pengawas.historyMonitoring') }}"
           class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-300 ease-in-out transform hover:scale-105">
            📄 Lihat History Monitoring
        </a>
    </div>
@endsection

