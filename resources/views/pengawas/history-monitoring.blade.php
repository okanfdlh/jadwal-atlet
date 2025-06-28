@extends('admin.layout')

@section('title', 'Riwayat Monitoring Atlet')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white/90 backdrop-blur-md shadow-2xl rounded-xl p-8 border border-gray-200">
    <h2 class="text-2xl font-bold text-blue-700 mb-6 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 17v-2a4 4 0 014-4h6m0 0V7m0 4l-2-2m2 2l2-2M4 6h16M4 10h16M4 14h16M4 18h16" />
        </svg>
        Riwayat Monitoring Atlet
    </h2>

    <!-- Filter Tanggal -->
    <form method="GET" action="{{ route('pengawas.historyMonitoring') }}" class="mb-6 flex gap-3 items-center">
        <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="border p-2 rounded-md shadow-sm">
        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">Filter</button>
        <a href="{{ route('pengawas.historyMonitoring') }}"
           class="text-sm text-gray-500 hover:underline ml-2">Reset</a>
    </form>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border border-gray-300 shadow-sm rounded-lg">
            <thead class="bg-blue-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">#</th>
                    <th class="px-4 py-2 text-left">Nama Atlet</th>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Jenis Latihan</th>
                    <th class="px-4 py-2 text-left">Berat (kg)</th>
                    <th class="px-4 py-2 text-left">Tinggi (cm)</th>
                    <th class="px-4 py-2 text-left">Otot Kanan</th>
                    <th class="px-4 py-2 text-left">Otot Kiri</th>
                    <th class="px-4 py-2 text-left">Repetisi</th>
                    <th class="px-4 py-2 text-left">Waktu</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($histories as $index => $history)
                    @php
                        $jenisKelamin = $history->jenis_kelamin ?? null;
                        $jenisLatihan = $jenisKelamin === 'L' ? 'Pull Up' : ($jenisKelamin === 'P' ? 'Chin Up' : '-');
                    @endphp
                    <tr class="border-t hover:bg-blue-50">
                        <td class="px-4 py-2">{{ $histories->firstItem() + $index }}</td>
                        <td class="px-4 py-2">{{ $atlet->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($history->created_at)->format('d M Y') }}</td>
                        <td class="px-4 py-2">{{ $jenisLatihan }}</td>
                        <td class="px-4 py-2">{{ $history->berat }}</td>
                        <td class="px-4 py-2">{{ $history->tinggi }}</td>
                        <td class="px-4 py-2">{{ $history->otot_kanan }}</td>
                        <td class="px-4 py-2">{{ $history->otot_kiri }}</td>
                        <td class="px-4 py-2">{{ $history->repitisi }}</td>
                        <td class="px-4 py-2">{{ $history->waktu_firebase }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center py-4 text-gray-500">Belum ada data monitoring.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $histories->withQueryString()->links() }}
    </div>

    <!-- Tombol Kembali -->
    <div class="text-center mt-8">
        <a href="{{ route('pengawas.jenisLatihan') }}"
           class="inline-flex items-center justify-center bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 text-white text-lg font-semibold py-3 px-6 rounded-full shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            ⬅️ Kembali
        </a>
    </div>
</div>
@endsection
