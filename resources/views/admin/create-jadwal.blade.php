@extends('layouts.app')

@section('title', 'Tambah Jadwal')
@section('header', 'Tambah Jadwal')
@section('subheader', '')

@section('content')
<div class="mb-4">
   <a href="{{ route('admin.jadwalGabungan') }}" 
    class="inline-block bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">
        &larr; Kembali
    </a>
</div>

<div class="bg-white p-6 rounded shadow">
    <form method="POST" action="{{ route('jadwal.store') }}">
        @csrf

        {{-- Dropdown Pengawas --}}
        <label class="block mb-2">Nama Pengawas</label>
        <select name="pengawas_id" class="w-full border p-2 rounded mb-3" required>
            <option value="" disabled selected>Pilih Pengawas</option>
            @foreach($pengawas as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        {{-- Dropdown Atlet --}}
        <label class="block mb-2">Nama Atlet</label>
        <select name="atlet_id" class="w-full border p-2 rounded mb-3" required>
            <option value="" disabled selected>Pilih Atlet</option>
            @foreach($atlet as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        {{-- jenis latihan --}}
        <label class="block mb-2">Jenis Latihan</label>
        <select name="type" class="w-full border p-2 rounded mb-3" required>
            <option value="">--Pilih Jenis Latihan--</option>
            <option value="chinning">Chinning</option>
            <option value="pullup">Pullup</option>
            <!-- jenis lain jika ada -->
        </select>


        {{-- Tanggal --}}
        <label class="block mb-2">Tanggal</label>
        <input type="date" name="day" class="w-full border p-2 rounded mb-3" required>

        {{-- Waktu --}}
        <label class="block mb-2">Waktu</label>
        <input type="time" name="time" class="w-full border p-2 rounded mb-3" required>

        {{-- Submit --}}
        <button class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
            Simpan Jadwal
        </button>
    </form>
</div>
@endsection
