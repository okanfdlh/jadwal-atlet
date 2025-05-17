@extends('admin.layout')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow mt-6">
    <h2 class="text-2xl font-bold mb-4">Dashboard Chinning Up</h2>

    {{-- Skor dan Waktu --}}
    <div class="grid grid-cols-2 gap-6 mb-6">
        <div class="bg-gray-100 p-4 rounded shadow">
            <h3 class="text-xl font-semibold">Skor</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $score }} poin</p>
        </div>
        <div class="bg-gray-100 p-4 rounded shadow">
            <h3 class="text-xl font-semibold">Waktu Pelatihan</h3>
            <p class="text-3xl font-bold text-green-600">{{ $training_time }} menit</p>
        </div>
    </div>

    {{-- Kekuatan Otot --}}
    <div class="bg-gray-100 p-6 rounded shadow mb-6">
        <h3 class="text-xl font-semibold mb-4">Kekuatan Otot</h3>
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block font-medium mb-1">Otot Kanan (kg)</label>
                <input type="number" name="otot_kanan" value="{{ $otot_kanan }}" class="w-full p-2 border rounded" readonly>
            </div>
            <div>
                <label class="block font-medium mb-1">Otot Kiri (kg)</label>
                <input type="number" name="otot_kiri" value="{{ $otot_kiri }}" class="w-full p-2 border rounded" readonly>
            </div>
        </div>
    </div>

    {{-- Pengaturan Dominasi Otot --}}
    <div class="bg-gray-100 p-6 rounded shadow">
        <h3 class="text-xl font-semibold mb-4">Pengaturan Dominasi Kekuatan Otot</h3>
        <form action="{{ route('atur-dominasi') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 font-medium">Dominan Otot</label>
                <select name="dominasi_otot" class="w-full p-2 border rounded">
                    <option value="kanan" {{ $dominasi_otot == 'kanan' ? 'selected' : '' }}>Otot Kanan</option>
                    <option value="kiri" {{ $dominasi_otot == 'kiri' ? 'selected' : '' }}>Otot Kiri</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan Pengaturan
            </button>
        </form>
    </div>
</div>
@endsection
