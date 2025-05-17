@extends('layouts.app')

@section('title', 'Jadwal Pengawas')
@section('header', 'Atur Jadwal Pengawas')
@section('subheader', '')

@section('content')
{{-- @if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ session('error') }}',
        timer: 2000,
        showConfirmButton: false
    });
</script> --}}
<div class="flex justify-end mb-4">
    <a href="{{ route('admin.tambahPengawas') }}" 
       class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
        Tambah Jadwal
    </a>
</div>
<div class="bg-white p-6 rounded-lg shadow-md relative">
    <div class="mb-10">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Jadwal Pengawas</h2>
        <p class="text-sm text-gray-500 mt-1">Berikut adalah daftar jadwal yang telah ditetapkan untuk para pengawas.</p>
    @if($jadwals->isEmpty())
        <div class="text-gray-500 text-center py-6 italic">Belum ada jadwal pengawas yang ditambahkan.</div>
    @else
        <div class="overflow-x-auto">
            <div class="mb-6">
                <form method="GET" action="{{ route('admin.jadwalPengawas') }}" class="flex flex-wrap gap-4 items-center">
                    <input type="text" name="search" placeholder="Cari nama pengawas..." 
                        value="{{ request('search') }}"
                        class="border border-gray-300 px-3 py-2 rounded w-56" />

                    <input type="date" name="date" value="{{ request('date') }}"
                        class="border border-gray-300 px-3 py-2 rounded" />

                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Filter
                    </button>

                    <a href="{{ route('admin.jadwalPengawas') }}" 
                    class="text-gray-500 hover:text-gray-700 underline ml-2">
                        Reset
                    </a>
                </form>
            </div>

            <table class="min-w-full border border-gray-200 text-left text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase">
                    <tr>
                        <th class="px-4 py-3 border-b">Nama</th>
                        <th class="px-4 py-3 border-b">Tanggal</th>
                        <th class="px-4 py-3 border-b">Waktu</th>
                        <th class="px-4 py-3 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($jadwals as $jadwal)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 border-b">{{ $jadwal->name }}</td>
                            <td class="px-4 py-3 border-b">{{ \Carbon\Carbon::parse($jadwal->day)->format('d-m-Y') }}</td>
                            <td class="px-4 py-3 border-b">{{ date('H:i', strtotime($jadwal->time)) }}</td>
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
