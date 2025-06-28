@extends('admin.layout')

@section('title', 'Lihat Jadwal Latihan')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-blue-700 mb-6">📅 Jadwal Latihan Atlet</h2>

    <form method="GET" action="{{ route('jadwal.index') }}" class="mb-6">
        <label for="filter" class="mr-2 font-semibold text-gray-700">Tampilkan berdasarkan:</label>
        <select name="filter" id="filter" onchange="this.form.submit()"
            class="border px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="hari" {{ $filter == 'hari' ? 'selected' : '' }}>Hari Ini</option>
            <option value="minggu" {{ $filter == 'minggu' ? 'selected' : '' }}>Minggu Ini</option>
            <option value="bulan" {{ $filter == 'bulan' ? 'selected' : '' }}>Bulan Ini</option>
        </select>
    </form>

    @if($jadwals->count())
        <div class="overflow-x-auto">
            <table class="min-w-full border rounded-xl">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="px-4 py-3 border">#</th>
                        <th class="px-4 py-3 border">Nama Atlet</th>
                        <th class="px-4 py-3 border">Jenis Latihan</th>
                        <th class="px-4 py-3 border">Hari</th>
                        <th class="px-4 py-3 border">Tanggal</th>
                        <th class="px-4 py-3 border">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwals as $i => $jadwal)
                        <tr class="hover:bg-blue-50">
                            <td class="px-4 py-2 border text-center">{{ $i + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $jadwal->atlet?->name ?? '-' }}</td>
                            <td class="px-4 py-2 border capitalize">{{ $jadwal->type }}</td>
                            <td class="px-4 py-2 border capitalize">{{ $jadwal->day }}</td>
                            <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($jadwal->date)->translatedFormat('d F Y') }}</td>
                            <td class="px-4 py-2 border">{{ $jadwal->time }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-600 text-center mt-4">Tidak ada jadwal latihan untuk filter ini.</p>
    @endif
</div>
@endsection
