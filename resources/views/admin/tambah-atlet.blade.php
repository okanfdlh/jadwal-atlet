@extends('layouts.app')

@section('title', 'Tambah Atlet')
@section('header', 'Tambah Jadwal Atlet')
@section('subheader', '')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.jadwalAtlet') }}" 
       class="inline-block bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">
        &larr; Kembali
    </a>
</div>
<div class="bg-white p-6 rounded shadow">
    <form method="POST" action="{{ route('jadwal.store') }}">
    @csrf
    <input type="hidden" name="type" value="atlet">
    
    <label class="block mb-2">Nama Atlet</label>
    <select name="name" class="w-full border p-2 rounded mb-3" required>
        <option value="" disabled selected>Pilih Atlet</option>
        @foreach($atlets as $atlet)
            <option value="{{ $atlet->name }}">{{ $atlet->name }}</option>
        @endforeach
    </select>

    
    <label class="block mb-2">Tanggal</label>
    <input type="date" name="day" class="w-full border p-2 rounded mb-3" required>
    
    <label class="block mb-2">Waktu</label>
    <input type="time" name="time" class="w-full border p-2 rounded mb-3" required>
    
    <button class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">Set Jadwal Atlet</button>
</form>

</div>
@endsection
