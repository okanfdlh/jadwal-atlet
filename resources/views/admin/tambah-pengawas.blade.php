@extends('layouts.app')

@section('title', 'Tambah Pengawas')
@section('header', 'Tambah Jadwal Pengawas')
@section('subheader', '')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.jadwalPengawas') }}" 
       class="inline-block bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">
        &larr; Kembali
    </a>
</div>
<div class="bg-white p-6 rounded shadow">
    <form method="POST" action="{{ route('jadwal.store') }}">
        @csrf
        <input type="hidden" name="type" value="pengawas">

        <label class="block mb-2">Nama Pengawas</label>
        <select name="name" class="w-full border p-2 rounded mb-3" required>
            <option value="" disabled selected>Pilih Pengawas</option>
            @foreach($pengawas as $p)
                <option value="{{ $p->name }}">{{ $p->name }}</option>
            @endforeach
        </select>

        <label class="block mb-2">Tanggal</label>
        <input type="date" name="day" class="w-full border p-2 rounded mb-3" required>

        <label class="block mb-2">Waktu</label>
        <input type="time" name="time" class="w-full border p-2 rounded mb-3" required>

        <button class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
            Set Jadwal Pengawas
        </button>
    </form>
</div>
@endsection
