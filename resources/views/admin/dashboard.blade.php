@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('header', 'Dashboard Admin')
@section('subheader', 'Ringkasan Sistem')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Card Total Pengguna -->
    <div class="bg-white border border-gray-200 rounded-xl shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500">Total Pengguna</p>
                <h3 class="text-2xl font-bold text-blue-600">{{ $totalUsers }}</h3>
            </div>
            <div class="text-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M9 12a4 4 0 100-8 4 4 0 000 8zM15 10h3m0 0v3m0-3h3m-3 0h-3"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Card Total Atlet -->
    <div class="bg-white border border-gray-200 rounded-xl shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500">Total Atlet</p>
                <h3 class="text-2xl font-bold text-green-600">{{ $totalAtlet }}</h3>
            </div>
            <div class="text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Card Jadwal Aktif -->
    <div class="bg-white border border-gray-200 rounded-xl shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500">Jadwal Hari Ini</p>
                <h3 class="text-2xl font-bold text-yellow-600">{{ $jadwalHariIni }}</h3>
            </div>
            <div class="text-yellow-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Grafik Pemantauan -->
<div class="mt-10 bg-white p-6 rounded-xl shadow-md">
    <h3 class="text-xl font-bold text-blue-700 mb-4">📊 Grafik Rata-Rata Skor per Atlet</h3>
    <canvas id="skorChart"></canvas>
</div>

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('skorChart').getContext('2d');
    const skorChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Rata-rata Skor',
                data: {!! json_encode($skorData) !!},
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
</script>
@endsection
