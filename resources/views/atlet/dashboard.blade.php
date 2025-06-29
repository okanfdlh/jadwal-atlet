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

    <!-- Filter Tanggal -->
    <div class="mb-8">
        <form method="GET" action="" class="flex items-center gap-4">
            <label for="filter_tanggal" class="text-gray-600">Filter Tanggal:</label>
            <input type="date" id="filter_tanggal" name="tanggal" value="{{ request('tanggal') }}"
                   class="border border-gray-300 rounded-lg px-3 py-2">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Terapkan</button>
        </form>
    </div>

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
    <div class="mb-12">
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
                        <th class="px-4 py-3 text-left">Skor</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 text-sm divide-y divide-gray-200">
                    @forelse($monitoring as $data)
                        <tr class="hover:bg-blue-50 transition duration-200">
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</td>
                            <td class="px-4 py-2">
                                {{ $data->jenis_kelamin == 'L' ? 'Pullup' : ($data->jenis_kelamin == 'P' ? 'Chinning' : '-') }}
                            </td>
                            <td class="px-4 py-2">{{ $data->berat }}</td>
                            <td class="px-4 py-2">{{ $data->tinggi }}</td>
                            <td class="px-4 py-2">{{ $data->repitisi }}</td>
                            <td class="px-4 py-2">{{ $data->otot_kanan }}</td>
                            <td class="px-4 py-2">{{ $data->otot_kiri }}</td>
                            <td class="px-4 py-2">{{ $data->waktu }}</td>
                            <td class="px-4 py-2">{{ $data->skor }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-6 text-gray-500">Belum ada data monitoring.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- <!-- Grafik -->
    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white p-4 rounded-lg border">
            <h4 class="font-semibold text-blue-700 mb-2">🏅 Grafik Skor</h4>
            <canvas id="chartSkor"></canvas>
        </div>
        <div class="bg-white p-4 rounded-lg border">
            <h4 class="font-semibold text-blue-700 mb-2">📊 Grafik Monitoring</h4>
            <canvas id="chartMonitoring"></canvas>
        </div>
    </div> --}}
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const skorChart = document.getElementById('chartSkor').getContext('2d');
    const monitoringChart = document.getElementById('chartMonitoring').getContext('2d');

    const labels = {!! json_encode($labels ?? []) !!};
    const skorData = {!! json_encode($skorData ?? []) !!};
    const beratData = {!! json_encode($beratData ?? []) !!};
    const repData = {!! json_encode($repData ?? []) !!};

    new Chart(skorChart, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Skor Latihan',
                data: skorData,
                backgroundColor: '#3b82f6'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });

    new Chart(monitoringChart, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Berat (kg)',
                    data: beratData,
                    borderColor: '#10b981',
                    tension: 0.4,
                    fill: false
                },
                {
                    label: 'Repetisi',
                    data: repData,
                    borderColor: '#f59e0b',
                    tension: 0.4,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endsection
