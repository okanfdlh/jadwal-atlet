@extends('admin.layout')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-center">Monitoring Pull Up</h2>

    {{-- Skor dan Waktu --}}
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="bg-blue-100 p-4 rounded">
            <h3 class="text-lg font-semibold">Skor</h3>
            <p class="text-2xl">{{ $score }}</p>
        </div>
        <div class="bg-green-100 p-4 rounded">
            <h3 class="text-lg font-semibold">Waktu Latihan</h3>
            <p class="text-2xl">{{ $training_time }} menit</p>
        </div>
    </div>

    {{-- Otot --}}
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="p-4 border rounded {{ $dominasi_otot == 'kanan' ? 'border-blue-500' : 'border-gray-300' }}">
            <h3 class="font-semibold">Kekuatan Otot Kanan</h3>
            <p class="text-xl">{{ $otot_kanan }} kg</p>
        </div>
        <div class="p-4 border rounded {{ $dominasi_otot == 'kiri' ? 'border-blue-500' : 'border-gray-300' }}">
            <h3 class="font-semibold">Kekuatan Otot Kiri</h3>
            <p class="text-xl">{{ $otot_kiri }} kg</p>
        </div>
    </div>

    {{-- Form Dominasi Otot --}}
    <form method="POST" action="{{ route('pullup.aturDominasi') }}" class="space-y-4">
        @csrf
        <div>
            <label for="dominasi_otot" class="block font-semibold mb-2">Pilih Dominasi Otot:</label>
            <select name="dominasi_otot" id="dominasi_otot" class="w-full p-2 border rounded">
                <option value="kanan" {{ $dominasi_otot == 'kanan' ? 'selected' : '' }}>Kanan</option>
                <option value="kiri" {{ $dominasi_otot == 'kiri' ? 'selected' : '' }}>Kiri</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan Dominasi
        </button>
    </form>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="mt-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif
</div>
@endsection
