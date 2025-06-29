@extends('admin.layout')

@section('title', 'Halaman Pengawas - Dashboard & Analisis Atlet')

@section('content')
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

<div class="bg-white shadow rounded-xl p-6">
    <h3 class="text-xl font-semibold text-blue-700 mb-4">📈 Grafik Monitoring Atlet</h3>
    <canvas id="grafikMonitoring" height="120"></canvas>
</div>
<div class="bg-white shadow rounded-xl p-6 mt-10">
    <h3 class="text-xl font-semibold text-red-600 mb-4">🏅 Grafik Skor Latihan Atlet</h3>
    <canvas id="grafikSkor" height="120"></canvas>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- Grafik Monitoring Atlet ---
    const ctxMonitoring = document.getElementById('grafikMonitoring');

    if (ctxMonitoring) {
        new Chart(ctxMonitoring, {
            type: 'line',
            data: {
                // Perbaikan di sini: Menggunakan $labelsMonitoring
                labels: {!! json_encode($labelsMonitoring) !!}, // Tanggal monitoring
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

    // --- Grafik Skor Latihan Atlet ---
    const skorCtx = document.getElementById('grafikSkor');
    const skorLabelsKategori = {!! json_encode($skor_kategori) !!};

    if (skorCtx) {
        new Chart(skorCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labelsSkor) !!}, // Menggunakan $labelsSkor
                datasets: [{
                    label: 'Skor Latihan',
                    data: {!! json_encode($skor) !!},
                    backgroundColor: '#ef4444',
                    borderColor: '#dc2626',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const index = context.dataIndex;
                                const label = skorLabelsKategori[index] ?? '';
                                return `Skor: ${label}`;
                            }
                        }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                const map = {
                                    10: 'Sangat Kurang',
                                    20: 'Kurang',
                                    40: 'Cukup',
                                    60: 'Baik',
                                    80: 'Baik Sekali',
                                    100: 'Sempurna'
                                };
                                return map[value] || value;
                            }
                        },
                        title: {
                            display: true,
                            text: 'Skor'
                        }
                    } ,
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    }
                }
            }
        });
    }
});
</script>
@endsection