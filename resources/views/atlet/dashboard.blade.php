@extends('layouts.atlet')

@section('title', 'Dashboard Atlet')

@section('content')
<div class="max-w-6xl mx-auto mt-12 bg-white/90 backdrop-blur-md border border-gray-200 rounded-2xl shadow-xl p-8">
    <h2 class="text-3xl font-bold text-blue-700 mb-8 flex items-center">
        <svg class="w-7 h-7 mr-2 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 7h18M3 12h18M3 17h18"/>
        </svg>
        Dashboard Atlet
    </h2>

    <!-- Jadwal Latihan -->
    <div class="mb-10">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">📅 Jadwal Latihan</h3>
        @forelse($jadwal as $item)
            <div class="flex items-center justify-between bg-blue-50 border border-blue-200 rounded-lg p-4 mb-3 shadow-sm">
                <p class="text-gray-700">
                    Hari: <span class="font-semibold">{{ ucfirst($item->day) }}</span><br>
                    Jam: <span class="font-semibold">{{ $item->time }}</span>
                </p>
            </div>
        @empty
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg">
                Belum ada jadwal latihan yang tersedia.
            </div>
        @endforelse
    </div>

    <!-- Riwayat Monitoring -->
    <div>
        <h3 class="text-xl font-semibold text-gray-800 mb-4">📊 Riwayat Monitoring</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 shadow rounded-lg overflow-hidden">
                <thead class="bg-blue-100 text-gray-700 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Jenis Latihan</th>
                        <th class="px-4 py-3 text-left">Berat (kg)</th>
                        <th class="px-4 py-3 text-left">Tinggi (cm)</th>
                        <th class="px-4 py-3 text-left">Repetisi</th>
                        <th class="px-4 py-3 text-left">Otot Kanan</th>
                        <th class="px-4 py-3 text-left">Otot Kiri</th>
                        <th class="px-4 py-3 text-left">Waktu (s)</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 text-sm divide-y divide-gray-200">
                    @forelse($monitoring as $data)
                        <tr class="hover:bg-blue-50 transition duration-200">
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</td>
                            <td class="px-4 py-2">{{ ucfirst($data->jenis_latihan) }}</td>
                            <td class="px-4 py-2">{{ $data->berat }}</td>
                            <td class="px-4 py-2">{{ $data->tinggi }}</td>
                            <td class="px-4 py-2">{{ $data->repitisi }}</td>
                            <td class="px-4 py-2">{{ $data->otot_kanan }}</td>
                            <td class="px-4 py-2">{{ $data->otot_kiri }}</td>
                            <td class="px-4 py-2">{{ $data->waktu_firebase }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-6 text-gray-500">Belum ada data monitoring.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
