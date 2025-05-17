@extends('admin.layout')

@section('title', 'Pilih Jenis Latihan')

@section('content')
<div class="max-w-md mx-auto bg-white p-10 rounded-xl shadow-lg text-center">
    <h2 class="text-2xl font-bold mb-8">Pilih Jenis Latihan Atlet</h2>
    
    <div class="space-y-6">
        <a href="{{ route('pengawas.inputParameter', ['jenis' => 'chinning']) }}"
           class="block bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-lg font-semibold transition">
           👩‍🦰 Chinning (Untuk Perempuan)
        </a>

        <a href="{{ route('pengawas.inputParameter', ['jenis' => 'pullup']) }}"
           class="block bg-purple-600 hover:bg-purple-700 text-white py-4 rounded-lg font-semibold transition">
           👨‍🦱 Pull Up (Untuk Laki-laki)
        </a>
    </div>
</div>
@endsection
