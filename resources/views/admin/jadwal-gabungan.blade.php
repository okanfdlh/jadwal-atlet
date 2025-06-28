@extends('layouts.app')

@section('title', 'Jadwal Gabungan')
@section('header', 'Jadwal Pengawas & Atlet')
@section('subheader', '')

@section('content')
<div class="flex justify-end mb-4">
    <a href="{{ route('admin.jadwal.create', ['type' => 'pengawas']) }}" 
       class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
        Tambah Jadwal
    </a>
</div>

<div class="bg-white p-6 rounded-lg shadow-md relative">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Jadwal Gabungan</h2>
        <form method="GET" action="{{ route('admin.jadwalGabungan') }}" class="flex flex-wrap gap-4 items-center mt-3">
            <input type="text" name="search" placeholder="Cari nama pengawas..." 
                value="{{ request('search') }}"
                class="border border-gray-300 px-3 py-2 rounded w-56" />

            <input type="date" name="date" value="{{ request('date') }}"
                class="border border-gray-300 px-3 py-2 rounded" />

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Filter
            </button>

            <a href="{{ route('admin.jadwalGabungan') }}" 
            class="text-gray-500 hover:text-gray-700 underline ml-2">
                Reset
            </a>
        </form>
    </div>

    @if($jadwals->isEmpty())
        <div class="text-gray-500 text-center py-6 italic">Belum ada jadwal ditambahkan.</div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 text-left text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase">
                    <tr>
                        <th class="px-4 py-3 border-b">Nama Pengawas</th>
                        <th class="px-4 py-3 border-b">Nama Atlet</th>
                        <th class="px-4 py-3 border-b">Tanggal</th>
                        <th class="px-4 py-3 border-b">Waktu</th>
                        <th class="px-4 py-3 border-b">Jenis Latihan</th>
                        <th class="px-4 py-3 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($jadwals as $jadwal)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 border-b">{{ $jadwal->pengawas->name ?? '-' }}</td>
                            <td class="px-4 py-3 border-b">{{ $jadwal->atlet->name ?? '-' }}</td>
                            <td class="px-4 py-3 border-b">{{ \Carbon\Carbon::parse($jadwal->day)->format('d-m-Y') }}</td>
                            <td class="px-4 py-3 border-b">{{ date('H:i', strtotime($jadwal->time)) }}</td>
                            <td class="px-4 py-3 border-b">{{ ucfirst($jadwal->type) ?? '-' }}</td>  {{-- Ini kolom jenis latihan --}}
                            <td class="px-4 py-3 border-b">
                                <a href="{{ route('admin.editJadwal', $jadwal->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                                <form action="{{ route('admin.destroyJadwal', $jadwal->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus jadwal ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $jadwals->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
