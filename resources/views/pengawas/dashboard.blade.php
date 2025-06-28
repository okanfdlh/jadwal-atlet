@extends('admin.layout')

@section('title', 'Halaman Pengawas - Dashboard & Analisis Atlet')

@section('content')
<!-- Ringkasan -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">
    <div class="bg-white shadow rounded-xl p-6">
        <h3 class="text-sm font-medium text-gray-500">Total Atlet</h3>
        <p class="text-3xl font-bold text-blue-700 mt-2">{{ $totalAtlet ?? 0 }}</p>
    </div>
    <div class="bg-white shadow rounded-xl p-6">
        <h3 class="text-sm font-medium text-gray-500">Total Jadwal</h3>
        <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalJadwal ?? 0 }}</p>
    </div>
    <div class="bg-white shadow rounded-xl p-6">
        <h3 class="text-sm font-medium text-gray-500">Tanggal</h3>
        <p class="text-3xl font-bold text-purple-600 mt-2">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
    </div>
</div>

<!-- Grafik Monitoring -->
<div class="bg-white shadow rounded-xl p-6">
    <h3 class="text-xl font-semibold text-blue-700 mb-4">📈 Grafik Monitoring Atlet</h3>
    <canvas id="grafikMonitoring" height="120"></canvas>
</div>
@endsection

@section('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('grafikMonitoring');

    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!}, // Tanggal monitoring
                datasets: [
                    {
                        label: 'Berat Badan (kg)',
                        data: {!! json_encode($berat) !!},
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Repetisi',
                        data: {!! json_encode($repitisi) !!},
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Otot Kanan',
                        data: {!! json_encode($otot_kanan) !!},
                        borderColor: '#f59e0b',
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Otot Kiri',
                        data: {!! json_encode($otot_kiri) !!},
                        borderColor: '#8b5cf6',
                        backgroundColor: 'rgba(139, 92, 246, 0.1)',
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});
</script>
@endsection
